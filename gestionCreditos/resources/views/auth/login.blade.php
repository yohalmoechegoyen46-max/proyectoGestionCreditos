<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Créditos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-wallet2 text-primary fs-1"></i>
                        <h4 class="fw-bold mt-2">Sistema Créditos</h4>
                        <p class="text-muted small">Ingresa tus credenciales para acceder</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="usuario">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" required placeholder="••••">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            Iniciar Sesión
                        </button>
                        <!-- Agrega esto debajo del botón de Ingresar en tu login.blade.php -->
<div class="text-center mt-3">
    <span class="text-muted">¿No tienes una cuenta?</span>
    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm ms-2">
        Registrarse
    </a>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>