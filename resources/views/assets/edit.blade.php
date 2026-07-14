@extends('layouts.app')

@section('title', 'Editar activo')

@section('content')
    <div class="card content-card">
        <div class="card-body">
            <h1 class="h4 mb-4">Editar activo</h1>

            <form
                action="{{ route('assets.update', $asset) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                @include('assets._form')

                <button class="btn btn-primary">
                    Actualizar
                </button>

                <a
                    href="{{ route('assets.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@endsection