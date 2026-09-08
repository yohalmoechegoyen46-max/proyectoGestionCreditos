@extends('layouts.app')

@section('title', 'Historial de Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Historial de Pagos</h2>
    <a href="{{ route('pagos.create') }}" class="btn btn-primary">Registrar Pago</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Crédito #</th>
                        <th>Cliente</th>
                        <th>Fecha Pago</th>
                        <th>Monto Abonado</th>
                        <th>Referencia</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>#{{ $pago->creditos_id }}</td>
                        <td>{{ $pago->credito->cliente->nombres ?? 'N/A' }} {{ $pago->credito->cliente->apellidos ?? '' }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                        <td class="fw-bold text-success">${{ number_format($pago->monto10, 2) }}</td>
                        <td>{{ $pago->referencia ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('pagos.show', $pago) }}" class="btn btn-info btn-sm text-white">Ver</a>
                            <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea anular este pago? El saldo volverá a sumarse al crédito.');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Anular</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay pagos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $pagos->links() }}
        </div>
    </div>
</div>
@endsection