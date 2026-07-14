@extends('layouts.app')

@section('title', 'Registrar tipo de activo')

@section('content')
    <div class="card content-card">
        <div class="card-header bg-white">
            <h1 class="h4 mb-0">
                Registrar tipo de activo
            </h1>
        </div>

        <div class="card-body">
            <form
                method="POST"
                action="{{ route('asset-types.store') }}"
            >
                @csrf

                @include('asset-types._form')

                <button
                    class="btn btn-primary"
                    type="submit"
                >
                    Guardar
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