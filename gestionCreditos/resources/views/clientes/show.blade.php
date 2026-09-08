@extends('layouts.app')

@section('title', 'Detalle de Cliente')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Información del Cliente</h5>
        <span class="badge {{ $cliente->estado == 'activo' ? 'bg-success' : 'bg-secondary' }}">
            {{ ucfirst($cliente->estado) }}
        </span>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-6">
                <p><strong>ID:</strong> {{ $cliente->id }}</p>
                <p><strong>Nombres:</strong> {{ $cliente->nombres }}</p>
                <p><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
                <p><strong>Documento de Identidad:</strong> {{ $cliente->documento_identidad }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $cliente->correo }}</p>
                <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            </div>
        </div>
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar Cliente</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>

<h4>Créditos Asociados</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Crédito</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Cuota</th>
                        <th>N° Cuotas</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($cliente->creditos as $credito)
                    <tr>
                        <td>{{ $credito->id }}</td>
                        <td>{{ $credito->fecha }}</td>
                        <td>${{ number_format($credito->monto, 2) }}</td>
                        <td>${{ number_format($credito->cuota, 2) }}</td>
                        <td>{{ $credito->ncuotas }}</td>
                        <td>{{ $credito->tipo }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Este cliente no posee créditos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection