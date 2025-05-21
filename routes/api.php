<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TarjetaController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\GameController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas públicas para tarjetas (sin autenticación)
Route::get('/tarjetas', [TarjetaController::class, 'index']);         // Listar todas tarjetas
Route::get('/tarjetas/{id}', [TarjetaController::class, 'show']);     // Mostrar tarjeta por id
Route::get('/tarjetas/publicas', [TarjetaController::class, 'publicCards']); // Tarjetas públicas

// Rutas protegidas (requieren autenticación)
Route::middleware([IsUserAuth::class])->group(function () {

    // Usuario logueado
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'getUser']);

    // Rutas de tarjetas privadas (propias)
    Route::get('/tarjetas/mias', [TarjetaController::class, 'myCards']);      // Listar tarjetas propias
    Route::post('/tarjetas', [TarjetaController::class, 'store']);            // Crear tarjeta (usuario actual)
    Route::put('/tarjetas/{id}', [TarjetaController::class, 'update']);       // Actualizar tarjeta (solo propietario o admin)
    Route::patch('/tarjetas/{id}', [TarjetaController::class, 'updatePartial']);
    Route::delete('/tarjetas/{id}', [TarjetaController::class, 'destroy']);

    // Rutas del juego protegidas
    Route::get('/games', [GameController::class, 'index']);
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{game}/finish', [GameController::class, 'update']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);
    Route::get('/ranking', [GameController::class, 'ranking']);
    Route::get('/games/user/{id}', [GameController::class, 'getGamesByUserId']);
});
