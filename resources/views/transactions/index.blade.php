@extends('layouts.app')

@section('title', 'Operaciones')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h1>Operaciones de inversión</h1>
            <p class="text-muted">
                Historial de compras y ventas simuladas.
            </p>
        </div>

        <a
            href="{{ route('transactions.create') }}"
            class="btn btn-primary align-self-start"
        >
            Nueva operación
        </a>
    </div>

    <div class="card content-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Activo</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->asset->symbol }}</td>
                            <td>
                                {{ ucfirst($transaction->type) }}
                            </td>
                            <td>
                                {{ number_format(
                                    $transaction->quantity,
                                    8
                                ) }}
                            </td>
                            <td>
                                ${{ number_format(
                                    $transaction->unit_price,
                                    2
                                ) }}
                            </td>
                            <td>
                                ${{ number_format(
                                    $transaction->total,
                                    2
                                ) }}
                            </td>
                            <td>
                                {{ $transaction->operation_date
                                    ->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                {{ ucfirst($transaction->status) }}
                            </td>
                            <td>
                                @if ($transaction->status === 'activa')
                                    <a
                                        href="{{ route(
                                            'transactions.edit',
                                            $transaction
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route(
                                            'transactions.destroy',
                                            $transaction
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            '¿Cancelar la operación?'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            type="submit"
                                        >
                                            Cancelar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="8"
                                class="text-center text-muted"
                            >
                                No hay operaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $transactions->links() }}
        </div>
    </div>
@endsection