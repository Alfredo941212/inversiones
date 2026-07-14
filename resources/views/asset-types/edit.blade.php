@extends('layouts.app')

@section('title', 'Editar tipo de activo')

@section('content')
    <div class="card content-card">
        <div class="card-header bg-white">
            <h1 class="h4 mb-0">
                Editar tipo de activo
            </h1>
        </div>

        <div class="card-body">
            <form
                method="POST"
                action="{{ route(
                    'asset-types.update',
                    $assetType
                ) }}"
            >
                @csrf
                @method('PUT')

                @include('asset-types._form')

                <button
                    class="btn btn-primary"
                    type="submit"
                >
                    Actualizar
                </button>

                <a
                    href="{{ route('asset-types.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@endsection