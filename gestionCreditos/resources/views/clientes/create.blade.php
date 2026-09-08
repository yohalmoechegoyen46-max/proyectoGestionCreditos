@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Registrar Nuevo Cliente</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="nombres" class="form-label fw-bold text-dark">Nombres</label>
                            <input type="text" name="nombres" id="nombres" 
                                class="form-control @error('nombres') is-invalid @enderror" 
                                value="{{ old('nombres') }}" required>
                            @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="apellidos" class="form-label fw-bold text-dark">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" 
                                class="form-control @error('apellidos') is-invalid @enderror" 
                                value="{{ old('apellidos') }}" required>
                            @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="documento_identidad" class="form-label fw-bold text-dark">Documento de Identidad (DUI)</label>
                            <input type="text" name="documento_identidad" id="documento_identidad" 
                                class="form-control @error('documento_identidad') is-invalid @enderror" 
                                value="{{ old('documento_identidad') }}" required>
                            @error('documento_identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label fw-bold text-dark">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" 
                                class="form-control @error('telefono') is-invalid @enderror" 
                                value="{{ old('telefono') }}" required>
                            @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label fw-bold text-dark">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" 
                            class="form-control @error('correo') is-invalid @enderror" 
                            value="{{ old('correo') }}" required>
                        @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label fw-bold text-dark">Dirección</label>
                        <textarea name="direccion" id="direccion" rows="3" 
                            class="form-control @error('direccion') is-invalid @enderror" required>{{ old('direccion') }}</textarea>
                        @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="form-label fw-bold text-dark">Estado</label>
                        <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                            <option value="activo" {{ old('estado', 'activo') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-semibold">
                            Guardar Cliente
                        </button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary fw-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection