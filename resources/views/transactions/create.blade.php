@extends('layouts.app')

@section('title', 'Nueva operación')

@section('content')
    <div class="card content-card">
        <div class="card-body">
            <h1 class="h4 mb-4">
                Registrar operación
            </h1>

            <form
                action="{{ route('transactions.store') }}"
                method="POST"
            >
                @csrf

                @include('transactions._form')

                <button class="btn btn-primary">
                    Guardar operación
                </button>

                <a
                    href="{{ route('transactions.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@endsection