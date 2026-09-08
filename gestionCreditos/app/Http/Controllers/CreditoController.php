<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function index()
    {
        $creditos = Credito::with('cliente')->orderBy('id', 'desc')->paginate(10);
        return view('creditos.index', compact('creditos'));
    }

    public function create()
    {
        $clientes = Cliente::where('estado', 'activo')->get();
        return view('creditos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clientes_id' => 'required|exists:clientes,id',
            'fecha_otorgamiento' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_otorgamiento',
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo' => 'required|integer|min:1',
        ]);

        $monto = $request->monto;
        $tasa = $request->tasa_interes;
        $total_credito = $monto + ($monto * ($tasa / 100));

        Credito::create([
            'clientes_id' => $request->clientes_id,
            'fecha_otorgamiento' => $request->fecha_otorgamiento,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'monto' => $monto,
            'tasa_interes' => $tasa,
            'plazo' => $request->plazo,
            'total_credito' => $total_credito,
            'saldo' => $total_credito,
            'estado' => 'activo',
        ]);

        return redirect()->route('creditos.index')
            ->with('success', 'Crédito otorgado exitosamente.');
    }

    public function show(Credito $credito)
    {
        $credito->load('cliente');
        return view('creditos.show', compact('credito'));
    }

    public function edit(Credito $credito)
    {
        $clientes = Cliente::all();
        return view('creditos.edit', compact('credito', 'clientes'));
    }

    public function update(Request $request, Credito $credito)
    {
        $request->validate([
            'clientes_id' => 'required|exists:clientes,id',
            'fecha_otorgamiento' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_otorgamiento',
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo,cancelado,pagado',
        ]);

        $monto = $request->monto;
        $tasa = $request->tasa_interes;
        $total_credito = $monto + ($monto * ($tasa / 100));

        $credito->update([
            'clientes_id' => $request->clientes_id,
            'fecha_otorgamiento' => $request->fecha_otorgamiento,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'monto' => $monto,
            'tasa_interes' => $tasa,
            'plazo' => $request->plazo,
            'total_credito' => $total_credito,
            'saldo' => $total_credito, // Se recalcula en base al nuevo total
            'estado' => $request->estado,
        ]);

        return redirect()->route('creditos.index')
            ->with('success', 'Crédito actualizado exitosamente.');
    }

    public function destroy(Credito $credito)
    {
        $credito->delete();

        return redirect()->route('creditos.index')
            ->with('success', 'Crédito eliminado correctamente.');
    }
}