@extends('layouts.app')

@section('title', 'Editar operación')

@section('content')
    <div class="card content-card">
        <div class="card-body">
            <h1 class="h4 mb-4">
                Editar operación
            </h1>

            <form
                action="{{ route(
                    'transactions.update',
                    $transaction
                ) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                @include('transactions._form')

                <button class="btn btn-primary">
                    Actualizar operación
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