<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sistema de Créditos')
    </title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        :root {

            --sidebar-width: 250px;

        }


        /* =========================================================
           CONFIGURACIÓN GENERAL
        ========================================================= */

        html,
        body {

            margin: 0;
            padding: 0;

            min-height: 100%;

        }


        body {

            background-color: #f8fafc;

            font-family:
                'Segoe UI',
                Tahoma,
                Geneva,
                Verdana,
                sans-serif;

            min-height: 100vh;

            overflow-x: hidden;

        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {

            width: var(--sidebar-width);

            height: 100vh;

            position: fixed;

            top: 0;
            left: 0;

            background:
                linear-gradient(
                    180deg,
                    #0f172a 0%,
                    #1e293b 100%
                );

            color: #fff;

            z-index: 1050;

            box-shadow:
                4px 0 10px rgba(0, 0, 0, 0.05);

            transition:
                transform 0.3s ease;

        }


        /* Marca */

        .sidebar .brand {

            font-size: 1.25rem;

            font-weight: 700;

            padding: 1.5rem 1.25rem;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.1);

            color: #fff;

            text-decoration: none;

            display: flex;

            align-items: center;

        }


        /* Menú */

        .sidebar .nav-link {

            color: #94a3b8;

            padding:
                0.85rem 1.25rem;

            font-weight: 500;

            border-radius: 8px;

            margin:
                0.2rem 0.8rem;

            transition:
                all 0.2s ease-in-out;

            display: flex;

            align-items: center;

        }


        .sidebar .nav-link:hover {

            color: #fff;

            background-color:
                rgba(255, 255, 255, 0.08);

        }


        .sidebar .nav-link.active {

            color: #fff;

            background-color: #4f46e5;

            box-shadow:
                0 4px 12px
                rgba(79, 70, 229, 0.35);

        }


        /* =========================================================
           CONTENIDO PRINCIPAL
        ========================================================= */

        .main-wrapper {

            margin-left: var(--sidebar-width);

            padding: 2rem;

            min-height: 100vh;

            transition:
                margin-left 0.3s ease;

        }


        .card-custom {

            border: none;

            border-radius: 12px;

            box-shadow:
                0 10px 15px -3px rgba(0,0,0,0.05),
                0 4px 6px -2px rgba(0,0,0,0.025);

        }


        /* =========================================================
           BOTÓN DEL MENÚ MÓVIL
        ========================================================= */

        .mobile-navbar {

            display: none;

            background:
                linear-gradient(
                    90deg,
                    #0f172a 0%,
                    #1e293b 100%
                );

            color: #fff;

            padding: 0.75rem 1rem;

            position: sticky;

            top: 0;

            z-index: 1040;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.15);

        }


        .mobile-navbar .brand-mobile {

            color: #fff;

            text-decoration: none;

            font-weight: 700;

            font-size: 1.1rem;

        }


        .mobile-menu-button {

            border: none;

            background: transparent;

            color: #fff;

            font-size: 1.6rem;

            padding: 0;

        }


        /* =========================================================
           OVERLAY PARA MÓVIL
        ========================================================= */

        .sidebar-overlay {

            display: none;

            position: fixed;

            inset: 0;

            background:
                rgba(0, 0, 0, 0.5);

            z-index: 1045;

        }


        /* =========================================================
           TABLETS
        ========================================================= */

        @media (max-width: 991.98px) {

            .sidebar {

                transform:
                    translateX(-100%);

            }


            .sidebar.show {

                transform:
                    translateX(0);

            }


            .sidebar-overlay.show {

                display: block;

            }


            .main-wrapper {

                margin-left: 0;

                padding: 1.5rem;

            }


            .mobile-navbar {

                display: flex;

                align-items: center;

                justify-content: space-between;

            }

        }


        /* =========================================================
           CELULARES
        ========================================================= */

        @media (max-width: 575.98px) {

            .main-wrapper {

                padding:
                    1rem 0.75rem;

            }


            .container-fluid {

                padding-left: 0.25rem;

                padding-right: 0.25rem;

            }


            .mobile-navbar {

                padding:
                    0.65rem 0.75rem;

            }


            .mobile-navbar .brand-mobile {

                font-size:
                    1rem;

            }


            /* Títulos */

            h1 {

                font-size:
                    1.5rem;

            }


            h2 {

                font-size:
                    1.35rem;

            }


            h3 {

                font-size:
                    1.2rem;

            }


            h4 {

                font-size:
                    1.1rem;

            }


            h5 {

                font-size:
                    1rem;

            }


            /* Alertas */

            .alert {

                font-size:
                    0.9rem;

            }


            /* Botones */

            .btn {

                font-size:
                    0.9rem;

            }


            /* Cards */

            .card-body {

                padding:
                    1rem;

            }


            /* Formularios */

            .form-control,
            .form-select {

                font-size:
                    0.95rem;

            }


            /* Tablas */

            .table {

                font-size:
                    0.85rem;

                white-space:
                    nowrap;

            }


            /* Botones dentro de tablas */

            .table .btn {

                margin-bottom:
                    0.25rem;

            }

        }


    </style>

</head>


<body>


    <!-- =========================================================
         NAVBAR MÓVIL
    ========================================================== -->

    <nav class="mobile-navbar">

        <a href="{{ route('clientes.index') }}"
           class="brand-mobile">

            <i class="bi bi-wallet2 me-2 text-primary"></i>

            Sistema Créditos

        </a>


        <button type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Abrir menú">

            <i class="bi bi-list"></i>

        </button>

    </nav>



    <!-- =========================================================
         OVERLAY
    ========================================================== -->

    <div class="sidebar-overlay"
         id="sidebarOverlay">
    </div>



    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    <aside class="sidebar d-flex flex-column"
           id="sidebar">


        <!-- Marca -->

        <a href="{{ route('clientes.index') }}"
           class="brand">

            <i class="bi bi-wallet2 me-2 text-primary fs-4"></i>

            <span>
                Sistema Créditos
            </span>

        </a>



        <!-- Menú -->

        <ul class="nav nav-pills flex-column mt-3">


            <!-- Clientes -->

            <li class="nav-item">

                <a class="nav-link
                    {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                   href="{{ route('clientes.index') }}">

                    <i class="bi bi-people me-2 fs-5"></i>

                    <span>
                        Clientes
                    </span>

                </a>

            </li>



            <!-- Créditos -->

            <li class="nav-item">

                <a class="nav-link
                    {{ request()->routeIs('creditos.*') ? 'active' : '' }}"
                   href="{{ route('creditos.index') }}">

                    <i class="bi bi-card-checklist me-2 fs-5"></i>

                    <span>
                        Créditos
                    </span>

                </a>

            </li>



            <!-- Pagos -->

            <li class="nav-item">

                <a class="nav-link
                    {{ request()->routeIs('pagos.*') ? 'active' : '' }}"
                   href="{{ route('pagos.index') }}">

                    <i class="bi bi-cash-coin me-2 fs-5"></i>

                    <span>
                        Pagos
                    </span>

                </a>

            </li>

        </ul>



        <!-- =====================================================
             USUARIO
        ====================================================== -->

        @auth

        <div class="mt-auto p-3 border-top border-secondary">


            <div class="d-flex align-items-center mb-2 px-1">

                <i class="bi bi-person-circle fs-4 me-2 text-primary">
                </i>


                <div class="text-truncate">

                    <span class="fw-semibold d-block text-white small">

                        {{ Auth::user()->name }}

                    </span>


                    <small class="text-muted d-block"
                           style="font-size: 0.75rem;">

                        Administrador

                    </small>

                </div>

            </div>



            <!-- Cerrar sesión -->

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="btn btn-outline-danger btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center mt-2">

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Cerrar Sesión

                </button>

            </form>

        </div>

        @endauth

    </aside>



    <!-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== -->

    <main class="main-wrapper">

        <div class="container-fluid">


            <!-- =================================================
                 MENSAJE DE ÉXITO
            ================================================== -->

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4"
                     role="alert">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}


                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Cerrar">
                    </button>

                </div>

            @endif



            <!-- =================================================
                 CONTENIDO DE CADA PÁGINA
            ================================================== -->

            @yield('content')


        </div>

    </main>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>



    <!-- =========================================================
         JAVASCRIPT MENÚ MÓVIL
    ========================================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const button =
                document.getElementById('mobileMenuButton');

            const sidebar =
                document.getElementById('sidebar');

            const overlay =
                document.getElementById('sidebarOverlay');


            if (!button || !sidebar || !overlay) {

                return;

            }


            function openMenu() {

                sidebar.classList.add('show');

                overlay.classList.add('show');

                document.body.style.overflow = 'hidden';

            }


            function closeMenu() {

                sidebar.classList.remove('show');

                overlay.classList.remove('show');

                document.body.style.overflow = '';

            }


            button.addEventListener(
                'click',
                openMenu
            );


            overlay.addEventListener(
                'click',
                closeMenu
            );


            /*
             * Cerrar menú automáticamente
             * cuando se selecciona una opción.
             */

            sidebar
                .querySelectorAll('.nav-link')
                .forEach(function (link) {

                    link.addEventListener(
                        'click',
                        closeMenu
                    );

                });


            /*
             * Si se vuelve a una pantalla grande,
             * limpiar el estado del menú.
             */

            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth >= 992) {

                        closeMenu();

                    }

                }
            );

        });

    </script>


</body>

</html>