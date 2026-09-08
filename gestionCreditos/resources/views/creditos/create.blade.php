@extends('layouts.app')

@section('title', 'Nuevo Crédito')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Registrar Nuevo Crédito</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('creditos.store') }}" method="POST">
                    @csrf

                    <!-- Seleccionar Cliente -->
                    <div class="mb-3">
                        <label for="clientes_id" class="form-label fw-bold text-dark">Cliente</label>
                        <select name="clientes_id" id="clientes_id" class="form-select @error('clientes_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona un cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('clientes_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombres }} {{ $cliente->apellidos }} - (DUI: {{ $cliente->documento_identidad }})
                                </option>
                            @endforeach
                        </select>
                        @error('clientes_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Monto, Tasa y Plazo -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="monto" class="form-label fw-bold text-dark">Monto ($)</label>
                            <input type="number" step="0.01" name="monto" id="monto" 
                                class="form-control @error('monto') is-invalid @enderror" 
                                value="{{ old('monto') }}" required>
                            @error('monto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="tasa_interes" class="form-label fw-bold text-dark">Tasa Interés (%)</label>
                            <input type="number" step="0.01" name="tasa_interes" id="tasa_interes" 
                                class="form-control @error('tasa_interes') is-invalid @enderror" 
                                value="{{ old('tasa_interes') }}" placeholder="Ej. 10" required>
                            @error('tasa_interes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="plazo" class="form-label fw-bold text-dark">Plazo (meses)</label>
                            <input type="number" name="plazo" id="plazo" 
                                class="form-control @error('plazo') is-invalid @enderror" 
                                value="{{ old('plazo') }}" placeholder="Ej. 12" required>
                            @error('plazo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Fechas -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="fecha_otorgamiento" class="form-label fw-bold text-dark">Fecha Otorgamiento</label>
                            <input type="date" name="fecha_otorgamiento" id="fecha_otorgamiento" 
                                class="form-control @error('fecha_otorgamiento') is-invalid @enderror" 
                                value="{{ old('fecha_otorgamiento', date('Y-m-d')) }}" required>
                            @error('fecha_otorgamiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_vencimiento" class="form-label fw-bold text-dark">Fecha Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" 
                                class="form-control @error('fecha_vencimiento') is-invalid @enderror" 
                                value="{{ old('fecha_vencimiento') }}" required>
                            @error('fecha_vencimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-semibold">
                            Guardar Crédito
                        </button>
                        <a href="{{ route('creditos.index') }}" class="btn btn-secondary fw-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection