@extends('layouts.app')

@section('title', 'Tipos de activos')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h1>Tipos de activos</h1>
            <p class="text-muted">
                Catálogo de instrumentos financieros.
            </p>
        </div>

        <a
            href="{{ route('asset-types.create') }}"
            class="btn btn-primary align-self-start"
        >
            Registrar tipo
        </a>
    </div>

    <div class="card content-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Activos relacionados</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($assetTypes as $assetType)
                        <tr>
                            <td>{{ $assetType->name }}</td>
                            <td>
                                {{ $assetType->description ?: 'Sin descripción' }}
                            </td>
                            <td>{{ $assetType->assets_count }}</td>
                            <td>
                                @if ($assetType->is_active)
                                    <span class="badge bg-success">
                                        Activo
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a
                                    href="{{ route(
                                        'asset-types.edit',
                                        $assetType
                                    ) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'asset-types.destroy',
                                        $assetType
                                    ) }}"
                                    class="d-inline"
                                    onsubmit="return confirm(
                                        '¿Deseas eliminar este registro?'
                                    )"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        type="submit"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="5"
                                class="text-center text-muted"
                            >
                                No hay tipos de activos registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $assetTypes->links() }}
        </div>
    </div>
@endsection