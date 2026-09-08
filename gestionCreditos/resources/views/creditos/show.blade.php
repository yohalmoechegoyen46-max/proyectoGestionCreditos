@extends('layouts.app')

@section('title', 'Detalle del Crédito')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-info text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Detalles del Crédito #{{ $credito->id }}</h5>
                <span class="badge {{ $credito->estado == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($credito->estado) }}
                </span>
            </div>

            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h6 class="text-muted fw-bold">INFORMACIÓN DEL CLIENTE</h6>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $credito->cliente->nombres ?? 'N/A' }} {{ $credito->cliente->apellidos ?? '' }}</p>
                        <p class="mb-1"><strong>Documento:</strong> {{ $credito->cliente->documento_identidad ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Teléfono:</strong> {{ $credito->cliente->telefono ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-muted fw-bold">FECHAS</h6>
                        <p class="mb-1"><strong>Fecha Otorgamiento:</strong> {{ $credito->fecha_otorgamiento }}</p>
                        <p class="mb-1"><strong>Fecha Vencimiento:</strong> {{ $credito->fecha_vencimiento }}</p>
                        <p class="mb-1"><strong>Plazo:</strong> {{ $credito->plazo }} meses</p>
                    </div>
                </div>

                <hr>

                <div class="row my-4 text-center">
                    <div class="col-md-3">
                        <p class="text-muted mb-1">Monto Prestado</p>
                        <h4 class="fw-bold text-dark">${{ number_format($credito->monto, 2) }}</h4>
                    </div>
                    <div class="col-md-3">
                        <p class="text-muted mb-1">Tasa Interés</p>
                        <h4 class="fw-bold text-dark">{{ $credito->tasa_interes }}%</h4>
                    </div>
                    <div class="col-md-3">
                        <p class="text-muted mb-1">Total a Pagar</p>
                        <h4 class="fw-bold text-primary">${{ number_format($credito->total_credito, 2) }}</h4>
                    </div>
                    <div class="col-md-3">
                        <p class="text-muted mb-1">Saldo Pendiente</p>
                        <h4 class="fw-bold text-danger">${{ number_format($credito->saldo, 2) }}</h4>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('creditos.edit', $credito) }}" class="btn btn-warning text-white fw-semibold">Editar</a>
                    <a href="{{ route('creditos.index') }}" class="btn btn-secondary fw-semibold">Volver</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection