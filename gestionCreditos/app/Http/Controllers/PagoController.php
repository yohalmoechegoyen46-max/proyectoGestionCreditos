<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Credito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->get('buscar');

    $pagos = Pago::with('credito.cliente')
        ->when($buscar, function ($query, $buscar) {
            $query->where('numero_ticket', 'like', "%{$buscar}%")
                ->orWhere('referencia', 'like', "%{$buscar}%")
                ->orWhereHas('credito.cliente', function ($q) use ($buscar) {
                    $q->where('nombres', 'like', "%{$buscar}%")
                      ->orWhere('apellidos', 'like', "%{$buscar}%");
                });
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->appends(['buscar' => $buscar]);

    return view('pagos.index', compact('pagos', 'buscar'));
}
    public function create()
    {
        // Obtiene créditos activos con saldo mayor a 0
        $creditos = Credito::with('cliente')
            ->where('estado', 'activo')
            ->where('saldo', '>', 0)
            ->get();

        return view('pagos.create', compact('creditos'));
    }

    public function store(Request $request)
    {
        $credito = Credito::findOrFail($request->creditos_id);

        $request->validate([
            'creditos_id' => 'required|exists:creditos,id',
            'fecha_pago' => 'required|date',
            'monto10' => 'required|numeric|min:0.01|max:' . $credito->saldo,
            'referencia' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $credito) {
            // Generación automática del número de ticket (Ejemplo: TCK-000001)
            $ultimoPago = Pago::latest('id')->first();
            $siguienteNumero = $ultimoPago ? ($ultimoPago->id + 1) : 1;
            $numeroTicket = 'TCK-' . str_pad($siguienteNumero, 6, '0', STR_PAD_LEFT);

            // 1. Guardar el Pago con el ticket generado automáticamente
            Pago::create([
                'creditos_id'   => $request->creditos_id,
                'fecha_pago'    => $request->fecha_pago,
                'monto10'       => $request->monto10,
                'numero_ticket' => $numeroTicket,
                'referencia'    => $request->referencia ?? 'Efectivo / Ticket Interno',
                'observaciones' => $request->observaciones,
            ]);

            // 2. Descontar del saldo
            $nuevoSaldo = $credito->saldo - $request->monto10;
            $nuevoEstado = $nuevoSaldo <= 0 ? 'pagado' : 'activo';

            $credito->update([
                'saldo' => $nuevoSaldo,
                'estado' => $nuevoEstado,
            ]);
        });

        return redirect()->route('pagos.index')
            ->with('success', 'Abono registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load('credito.cliente');
        return view('pagos.show', compact('pago'));
    }

    public function destroy(Pago $pago)
    {
        DB::transaction(function () use ($pago) {
            $credito = $pago->credito;

            // Al eliminar un pago, reponemos ese monto al saldo del crédito
            $nuevoSaldo = $credito->saldo + $pago->monto10;

            $credito->update([
                'saldo' => $nuevoSaldo,
                'estado' => 'activo',
            ]);

            $pago->delete();
        });

        return redirect()->route('pagos.index')
            ->with('success', 'Pago anulado correctamente. El saldo fue devuelto al crédito.');
    }

    public function descargarPDF($id)
    {
        $pago = Pago::with('credito.cliente')->findOrFail($id);
        
        // Forzar la lectura del saldo actualizado en la BD
        $pago->credito->refresh();

        $pdf = Pdf::loadView('pagos.pdf', compact('pago'))
                  ->setPaper('a6', 'portrait');

        return $pdf->download('Comprobante_Pago_'.$pago->id.'.pdf');
    }
}