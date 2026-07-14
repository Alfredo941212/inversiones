@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h1>Dashboard de inversiones</h1>
        <p class="text-muted">
            Resumen de tu portafolio virtual.
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card summary-card">
                <div class="card-body">
                    <small class="text-muted">
                        Saldo inicial
                    </small>

                    <h3>
                        ${{ number_format($initialBalance, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card summary-card">
                <div class="card-body">
                    <small class="text-muted">
                        Saldo disponible
                    </small>

                    <h3>
                        ${{ number_format($availableBalance, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card summary-card">
                <div class="card-body">
                    <small class="text-muted">
                        Capital invertido
                    </small>

                    <h3>
                        ${{ number_format($investedCapital, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card summary-card">
                <div class="card-body">
                    <small class="text-muted">
                        Operaciones activas
                    </small>

                    <h3>{{ $activeOperations }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card content-card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Portafolio actual</h5>
        </div>

        <div class="card-body">
            @if ($portfolio->isEmpty())
                <p class="text-muted mb-0">
                    Todavía no tienes inversiones registradas.
                </p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Activo</th>
                            <th>Símbolo</th>
                            <th>Cantidad</th>
                            <th>Valor estimado</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($portfolio as $item)
                            <tr>
                                <td>{{ $item['asset']->name }}</td>
                                <td>{{ $item['asset']->symbol }}</td>
                                <td>
                                    {{ number_format($item['quantity'], 8) }}
                                </td>
                                <td>
                                    ${{ number_format(
                                        $item['estimated_value'],
                                        2
                                    ) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection