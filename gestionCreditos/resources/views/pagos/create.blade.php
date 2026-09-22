@extends('layouts.app')

@section('title', 'Registrar Pago')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Registrar Nuevo Abono</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('pagos.store') }}" method="POST">
                    @csrf

                    <!-- Selección de Crédito -->
                    <div class="mb-3">
                        <label for="creditos_id" class="form-label fw-bold text-dark">Seleccionar Crédito</label>
                        <select name="creditos_id" id="creditos_id" class="form-select @error('creditos_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona un crédito activo --</option>
                            @foreach($creditos as $credito)
                                <option value="{{ $credito->id }}" {{ old('creditos_id') == $credito->id ? 'selected' : '' }}>
                                    Crédito #{{ $credito->id }} - {{ $credito->cliente->nombres ?? '' }} {{ $credito->cliente->apellidos ?? '' }} (Saldo: ${{ number_format($credito->saldo, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('creditos_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Indicador de Ticket Automático -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Número de Ticket</label>
                        <input type="text" class="form-control bg-light text-muted" value="Ticket-Autogenerado" readonly disabled>
                        <small class="text-muted">El correlativo del ticket se asigna de forma automática en el sistema.</small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="monto10" class="form-label fw-bold text-dark">Monto a Abonar ($)</label>
                            <input type="number" step="0.01" name="monto10" id="monto10" 
                                class="form-control @error('monto10') is-invalid @enderror" 
                                value="{{ old('monto10') }}" required>
                            @error('monto10') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_pago" class="form-label fw-bold text-dark">Fecha de Pago</label>
                            <input type="date" name="fecha_pago" id="fecha_pago" 
                                class="form-control @error('fecha_pago') is-invalid @enderror" 
                                value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
                            @error('fecha_pago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="observaciones" class="form-label fw-bold text-dark">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" rows="3" 
                            class="form-control @error('observaciones') is-invalid @enderror"
                            placeholder="Detalles adicionales opcionales...">{{ old('observaciones') }}</textarea>
                        @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-semibold">
                            Registrar Abono
                        </button>
                        <a href="{{ route('pagos.index') }}" class="btn btn-secondary fw-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection