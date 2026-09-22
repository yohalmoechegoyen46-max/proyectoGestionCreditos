@extends('layouts.app')

@section('title', 'Comprobante de Pago')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-success text-white py-3 text-center">
                <h5 class="mb-0 fw-bold">Comprobante de Pago {{ $pago->numero_ticket ?? '#' . $pago->id }}</h5>
            </div>

            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <p class="text-muted mb-1">Monto Abonado</p>
                    <h2 class="fw-bold text-success">${{ number_format($pago->monto10, 2) }}</h2>
                    <span class="badge bg-secondary">Fecha: {{ $pago->fecha_pago }}</span>
                </div>

                <hr>

                <div class="mb-3">
                    <p class="mb-1">
                        <strong>Número de Ticket:</strong> 
                        <span class="badge bg-primary fs-6">{{ $pago->numero_ticket ?? 'N/A' }}</span>
                    </p>
                    <p class="mb-1">
                        <strong>Cliente:</strong> 
                        {{ $pago->credito->cliente->nombres ?? 'N/A' }} {{ $pago->credito->cliente->apellidos ?? '' }}
                    </p>
                    <p class="mb-1"><strong>Crédito Asociado:</strong> #{{ $pago->creditos_id }}</p>
                    <p class="mb-1">
                        <strong>Saldo Actual del Crédito:</strong> 
                        ${{ number_format($pago->credito->saldo ?? 0, 2) }}
                    </p>
                    <p class="mb-1"><strong>Referencia:</strong> {{ $pago->referencia ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Observaciones:</strong> {{ $pago->observaciones ?? 'Sin observaciones' }}</p>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <a href="{{ route('pagos.pdf', $pago->id) }}" class="btn btn-danger fw-semibold" target="_blank">
                        Descargar Comprobante PDF
                    </a>
                    @if(isset($pago->credito->cliente))
                        <a href="{{ route('clientes.show', $pago->credito->cliente->id) }}" class="btn btn-info text-white fw-semibold">
                            Volver al Cliente
                        </a>
                    @endif
                    <a href="{{ route('pagos.index') }}" class="btn btn-secondary fw-semibold">Volver al Historial de Pagos</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection