@extends('layouts.app')

@section('title', 'Registrar activo')

@section('content')
    <div class="card content-card">
        <div class="card-body">
            <h1 class="h4 mb-4">Registrar activo</h1>

            <form
                action="{{ route('assets.store') }}"
                method="POST"
            >
                @csrf

                @include('assets._form')

                <button class="btn btn-primary">
                    Guardar
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