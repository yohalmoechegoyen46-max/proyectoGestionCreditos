@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="row justify-content-center align-items-center style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center fw-bold mb-4">Crear una Cuenta</h3>

                {{-- Mostrar errores globales --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="name" class="form-label font-semibold">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Tu nombre">
                    </div>

                    <!-- Correo -->
                    <div class="mb-3">
                        <label for="email" class="form-label font-semibold">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="ejemplo@correo.com">
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label font-semibold">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Mínimo 6 caracteres">
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label font-semibold">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Repite la contraseña">
                    </div>

                    <!-- Botón Registrar -->
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">
                        Registrarse
                    </button>

                    <!-- Enlace a Login -->
                    <div class="text-center">
                        <span class="text-muted">¿Ya tienes cuenta?</span>
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none ms-1">Inicia sesión aquí</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
