@extends('layouts.app')

@section('title', 'Cotizaciones')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold">
            Cotizaciones de acciones
        </h1>

        <p class="text-muted">
            Información financiera obtenida mediante Finnhub API.
        </p>
    </div>

    @if ($error)
        <div class="alert alert-danger">
            <strong>Error:</strong>

            {{ $error }}
        </div>
    @endif

    <div class="row g-4">
        @foreach ($assets as $symbol => $name)
            @php
                $quote = $quotes[$symbol] ?? null;

                $currentPrice = (float) (
                    $quote['c'] ?? 0
                );

                $change = (float) (
                    $quote['d'] ?? 0
                );

                $changePercent = (float) (
                    $quote['dp'] ?? 0
                );
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card content-card h-100">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between
                                   align-items-start"
                        >
                            <div>
                                <h2 class="h5 fw-bold mb-1">
                                    {{ $name }}
                                </h2>

                                <p class="text-muted">
                                    {{ $symbol }}
                                </p>
                            </div>

                            @if ($quote)
                                <span
                                    class="badge
                                    {{ $changePercent >= 0
                                        ? 'bg-success'
                                        : 'bg-danger' }}"
                                >
                                    {{ $changePercent >= 0 ? '+' : '' }}

                                    {{ number_format(
                                        $changePercent,
                                        2
                                    ) }}%
                                </span>
                            @endif
                        </div>

                        @if ($quote)
                            <p class="display-6 fw-bold">
                                ${{ number_format(
                                    $currentPrice,
                                    2
                                ) }}
                            </p>

                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <th>Apertura</th>

                                    <td class="text-end">
                                        ${{ number_format(
                                            (float) ($quote['o'] ?? 0),
                                            2
                                        ) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Máximo</th>

                                    <td class="text-end">
                                        ${{ number_format(
                                            (float) ($quote['h'] ?? 0),
                                            2
                                        ) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Mínimo</th>

                                    <td class="text-end">
                                        ${{ number_format(
                                            (float) ($quote['l'] ?? 0),
                                            2
                                        ) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Cierre anterior</th>

                                    <td class="text-end">
                                        ${{ number_format(
                                            (float) ($quote['pc'] ?? 0),
                                            2
                                        ) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Cambio</th>

                                    <td
                                        class="text-end
                                        {{ $change >= 0
                                            ? 'text-success'
                                            : 'text-danger' }}"
                                    >
                                        {{ $change >= 0 ? '+' : '' }}

                                        ${{ number_format(
                                            $change,
                                            2
                                        ) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                Información no disponible.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="alert alert-warning mt-4">
        <strong>Aviso:</strong>

        InverTrack es un simulador educativo y no constituye
        asesoría financiera.
    </div>
@endsection