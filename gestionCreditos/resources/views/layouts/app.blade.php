<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Créditos')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
        }
        .btn-custom-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-custom-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
            color: white;
            transform: translateY(-1px);
        }
        .table-custom thead {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('clientes.index') }}">
                <i class="bi bi-wallet2 me-2 text-primary"></i>Sistema Créditos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Opción Clientes -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }} fw-medium" href="{{ route('clientes.index') }}">
                            <i class="bi bi-people me-1"></i> Clientes
                        </a>
                    </li>
                    <!-- Opción Créditos -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('creditos.*') ? 'active' : '' }} fw-medium" href="{{ route('creditos.index') }}">
                            <i class="bi bi-card-checklist me-1"></i> Créditos
                        </a>
                    </li>
                    <!-- Opción Pagos -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }} fw-medium" href="{{ route('pagos.index') }}">
                            <i class="bi bi-cash-coin me-1"></i> Pagos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>