<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;

// Vista principal de inicio (Dashboard)
Route::get('/', function () {
    return view('home');
})->name('home');

// Ruta personalizada para reactivar un cliente inactivo
Route::patch('clientes/{cliente}/activar', [ClienteController::class, 'activar'])->name('clientes.activar');

// Rutas estándar del CRUD para clientes
Route::resource('clientes', ClienteController::class);

// Rutas estándar del CRUD para créditos
Route::resource('creditos', CreditoController::class);

// Rutas estándar del CRUD para pagos
Route::resource('pagos', PagoController::class);