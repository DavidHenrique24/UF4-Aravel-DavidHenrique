<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TarjetaController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Middleware\IsAdmin;


Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware([IsUserAuth::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
   Route::get('me',[AuthController::class, 'getUser']);
    Route::get('/tarjetas/{id}', [TarjetaController::class, 'getTarjeta']);

});
Route::get('/tarjetas', [TarjetaController::class, 'index']);
Route::post('/tarjetas', [TarjetaController::class, 'store']);
Route::get('/tarjetas/{id}', [TarjetaController::class, 'show']);
Route::put('/tarjetas/{id}', [TarjetaController::class, 'update']);
Route::patch('/tarjetas/{id}', [TarjetaController::class, 'updatePartial']);
Route::delete('/tarjetas/{id}', [TarjetaController::class, 'destroy']);






