<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComisionController;

// Ruta raíz: redirige directamente al MiniCore
Route::get('/', function () {
    return redirect()->route('comisiones.index');
});

// Rutas del MiniCore
Route::get('/comisiones', [ComisionController::class, 'index'])
     ->name('comisiones.index');

Route::post('/comisiones', [ComisionController::class, 'calcular'])
     ->name('comisiones.calcular');
