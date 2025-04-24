<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TarjetaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/tarjetas', function () { return 'Lista de Tarjetas Smash'; });
// Route::post('/tarjetas', function () { return 'Creando Tarjeta Smash'; });
// Route::put('/tarjetas/{id}', function () { return 'Actu tarjetas'; });
// Route::delete('/tarjetas/{id}', function () { return 'Deleting Tarjeta'; });
// Route::get('/tarjetas/{id}', function () { return 'Getting single Tarjeta'; });

Route::get('/tarjetas', [TarjetaController::class, 'index']);
Route::post('/tarjetas', [TarjetaController::class, 'store']);
Route::get('/tarjetas/{id}', [TarjetaController::class, 'show']);
Route::put('/tarjetas/{id}', [TarjetaController::class, 'update']);
Route::patch('/tarjetas/{id}', [TarjetaController::class, 'updatePartial']);
Route::delete('/tarjetas/{id}', [TarjetaController::class, 'destroy']);
