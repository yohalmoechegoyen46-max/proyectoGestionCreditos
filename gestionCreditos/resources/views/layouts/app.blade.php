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
        :root {
            --sidebar-width: 250px;
        }
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        /* Sidebar Fijo Lateral */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
        }
        .sidebar .brand {
            font-size: 1.25rem;
            font-weight: 700;
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.85rem 1.25rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 0.2rem 0.8rem;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.08);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #4f46e5;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }
        /* Contenido Principal con Offset */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
        }
    </style>
</head>
<body>

    <!-- Sidebar Lateral -->
    <aside class="sidebar d-flex flex-column">
        <a href="{{ route('clientes.index') }}" class="brand">
            <i class="bi bi-wallet2 me-2 text-primary fs-4"></i>
            <span>Sistema Créditos</span>
        </a>

        <ul class="nav nav-pills flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                    <i class="bi bi-people me-2 fs-5"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('creditos.*') ? 'active' : '' }}" href="{{ route('creditos.index') }}">
                    <i class="bi bi-card-checklist me-2 fs-5"></i>
                    <span>Créditos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }}" href="{{ route('pagos.index') }}">
                    <i class="bi bi-cash-coin me-2 fs-5"></i>
                    <span>Pagos</span>
                </a>
            </li>
        </ul>

        <!-- Sección del Usuario Logueado y Cerrar Sesión -->
        @auth
        <div class="mt-auto p-3 border-top border-secondary">
            <div class="d-flex align-items-center mb-2 px-1">
                <i class="bi bi-person-circle fs-4 me-2 text-primary"></i>
                <div class="text-truncate">
                    <span class="fw-semibold d-block text-white small">{{ Auth::user()->name }}</span>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Administrador</small>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center mt-2">
                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <!-- Contenido Principal -->
    <main class="main-wrapper">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>