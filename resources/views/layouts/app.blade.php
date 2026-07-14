
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
        background-color: #F5EBDD; /* Fondo crema */
    }

    .navbar {
        background-color: #D9D9D9 !important; /* Gris suave */
    }

    .navbar-brand {
        font-weight: 700;
        color: #5C4636 !important; /* Café elegante */
    }

    .summary-card {
        border: 0;
        border-radius: 18px;
        background-color: #FFFFFF;
        box-shadow: 0 5px 18px rgba(92, 70, 54, .12);
    }

    .content-card {
        border: 0;
        border-radius: 18px;
        background-color: #E8D8C3; /* Beige */
        box-shadow: 0 5px 18px rgba(92, 70, 54, .10);
    }

    .btn-primary {
        background-color: #B08968;
        border-color: #B08968;
    }

    .btn-primary:hover {
        background-color: #8C6A4A;
        border-color: #8C6A4A;
    }

    h1, h2, h3, h4, h5 {
        color: #5C4636;
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