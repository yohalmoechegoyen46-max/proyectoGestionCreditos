@extends('layouts.app')

@section('title', 'Listado de Créditos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Créditos</h2>
    <a href="{{ route('creditos.create') }}" class="btn btn-primary">Nuevo Crédito</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Interés (%)</th>
                        <th>Total</th>
                        <th>Saldo</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($creditos as $credito)
                    <tr>
                        <td>{{ $credito->id }}</td>
                        <td>{{ $credito->cliente->nombres ?? 'N/A' }} {{ $credito->cliente->apellidos ?? '' }}</td>
                        <td>${{ number_format($credito->monto, 2) }}</td>
                        <td>{{ $credito->tasa_interes }}%</td>
                        <td>${{ number_format($credito->total_credito, 2) }}</td>
                        <td class="fw-bold text-danger">${{ number_format($credito->saldo, 2) }}</td>
                        <td>{{ $credito->fecha_vencimiento }}</td>
                        <td>
                            <span class="badge {{ $credito->estado == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($credito->estado) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('creditos.show', $credito) }}" class="btn btn-info btn-sm text-white">Ver</a>
                            <a href="{{ route('creditos.edit', $credito) }}" class="btn btn-warning btn-sm text-white">Editar</a>
                            <form action="{{ route('creditos.destroy', $credito) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea eliminar este crédito?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No hay créditos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $creditos->links() }}
        </div>
    </div>
</div>
@endsection