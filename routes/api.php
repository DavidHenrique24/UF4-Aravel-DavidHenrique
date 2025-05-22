<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsAdmin;

//Rutas publicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Rutas protegidas
Route::middleware([IsAuthenticated::class])->group(function () {
Route::get('/pets', [PetController::class, 'index']);
Route::post('/pets', [PetController::class, 'store']);
Route::get('/pets/{id}', [PetController::class, 'show']);
Route::put('/pets/{id}', [PetController::class, 'update']);
Route::patch('/pets/{id}', [PetController::class, 'updatePartial']);
Route::delete('/pets/{id}', [PetController::class, 'destroy']);
Route::post('/logout', [AuthController::class, 'logout']); Route::post('/logout', [AuthController::class, 'logout']);

});

