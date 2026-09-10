@extends('layouts.app')

@section('title', 'Inicio - Panel Principal')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-dark">Bienvenido al Sistema de Gestión de Créditos</h2>
    <p class="text-muted">Selecciona una de las opciones del menú lateral o accede rápidamente a las acciones principales.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="bi bi-people fs-2"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">Clientes</h5>
                    <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-primary mt-1">Gestionar Clientes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle me-3">
                    <i class="bi bi-card-checklist fs-2"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">Créditos</h5>
                    <a href="{{ route('creditos.index') }}" class="btn btn-sm btn-outline-success mt-1">Ver Créditos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle me-3">
                    <i class="bi bi-cash-coin fs-2"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">Pagos</h5>
                    <a href="{{ route('pagos.index') }}" class="btn btn-sm btn-outline-info mt-1">Registrar Abonos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection