
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'InverTrack')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f4f7fb;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .summary-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .08);
        }

        .content-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a
            class="navbar-brand"
            href="{{ route('dashboard') }}"
        >
            InverTrack
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainMenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="mainMenu"
        >
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('dashboard') }}"
                    >
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('asset-types.index') }}"
                    >
                        Tipos de activos
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('assets.index') }}"
                    >
                        Activos
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('transactions.index') }}"
                    >
                        Operaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('quotes.index') }}"
                    >
                        Cotizaciones
                    </a>
                </li>
            </ul>

            <span class="navbar-text me-3">
                {{ auth()->user()->name }}
            </span>

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    class="btn btn-outline-light btn-sm"
                    type="submit"
                >
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>
</body>
</html>