<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento_identidad' => 'required|string|unique:clientes,documento_identidad',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:clientes,correo',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado exitosamente.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('creditos.pagos');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento_identidad' => 'required|string|unique:clientes,documento_identidad,' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:clientes,correo,' . $cliente->id,
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->update(['estado' => 'inactivo']);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente desactivado correctamente.');
    }

    public function activar(Cliente $cliente)
    {
        $cliente->update(['estado' => 'activo']);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente reactivado exitosamente.');
    }
}