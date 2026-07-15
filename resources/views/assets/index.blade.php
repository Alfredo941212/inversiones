@extends('layouts.app')

@section('title', 'Activos')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h1>Activos financieros</h1>
            <p class="text-muted">
                Consulta y mantenimiento de activos financieros.
            </p>
        </div>

        <a
            href="{{ route('assets.create') }}"
            class="btn btn-primary align-self-start"
        >
            Registrar activo
        </a>
    </div>

    <div class="card content-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Símbolo</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($assets as $asset)
                        <tr>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->symbol }}</td>
                            <td>{{ $asset->assetType->name }}</td>
                            <td>
                                ${{ number_format(
                                    $asset->current_price,
                                    2
                                ) }}
                            </td>
                            <td>
                                {{ $asset->is_active
                                    ? 'Activo'
                                    : 'Inactivo' }}
                            </td>
                            <td>
                                <a
                                    href="{{ route(
                                        'assets.edit',
                                        $asset
                                    ) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route(
                                        'assets.destroy',
                                        $asset
                                    ) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm(
                                        '¿Eliminar este activo?'
                                    )"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="6"
                                class="text-center"
                            >
                                No hay activos registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $assets->links() }}
        </div>
    </div>
@endsection
