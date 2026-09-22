<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;

// Rutas públicas (Login y Registro)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirección inicial
Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// Rutas protegidas (Solo con sesión iniciada)
Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::patch('/clientes/{cliente}/activar', [ClienteController::class, 'activar'])->name('clientes.activar');
    Route::resource('creditos', CreditoController::class);
    Route::resource('pagos', PagoController::class);
    Route::get('/pagos/{id}/pdf', [PagoController::class, 'descargarPDF'])->name('pagos.pdf');
});