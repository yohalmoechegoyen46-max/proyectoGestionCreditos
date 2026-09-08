<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Credito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('credito.cliente')->orderBy('id', 'desc')->paginate(10);
        return view('pagos.index', compact('pagos'));
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
            // 1. Guardar el Pago
            Pago::create([
                'creditos_id' => $request->creditos_id,
                'fecha_pago' => $request->fecha_pago,
                'monto10' => $request->monto10,
                'referencia' => $request->referencia,
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
            ->with('success', 'Abono registrado y saldo actualizado correctamente.');
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
}