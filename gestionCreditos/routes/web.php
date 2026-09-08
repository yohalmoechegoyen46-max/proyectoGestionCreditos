<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

// Redirige la raíz al listado de clientes
Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// Ruta personalizada para reactivar un cliente inactivo
Route::patch('clientes/{cliente}/activar', [ClienteController::class, 'activar'])->name('clientes.activar');

// Rutas estándar del CRUD para clientes
Route::resource('clientes', ClienteController::class);