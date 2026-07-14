<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
|
| Si el usuario inició sesión, se envía al dashboard.
| Si no inició sesión, se envía al login.
|
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
|
| Solo los usuarios autenticados pueden acceder a estas rutas.
|
*/

Route::middleware('auth')->group(function (): void {
    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'asset-types',
        AssetTypeController::class
    )->except(['show']);

    Route::resource(
        'assets',
        AssetController::class
    )->except(['show']);

    Route::resource(
        'transactions',
        TransactionController::class
    )->except(['show']);

    Route::get(
        '/quotes',
        [QuoteController::class, 'index']
    )->name('quotes.index');

    require __DIR__.'/settings.php';
});