<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TarjetaController;
use App\Http\Middleware\isUserAuth;
use App\Http\Middleware\isAdmin;
use App\Models\User;

Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);

// Rutas protegidas
Route::middleware([isUserAuth::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
   Route::get('me',[AuthController::class, 'getUser']);
   Route::post('students', [StudentController::class, 'addStudent']);

});
Route::get('/tarjetas', [TarjetaController::class, 'index']);
Route::post('/tarjetas', [TarjetaController::class, 'store']);
Route::get('/tarjetas/{id}', [TarjetaController::class, 'show']);
Route::put('/tarjetas/{id}', [TarjetaController::class, 'update']);
Route::patch('/tarjetas/{id}', [TarjetaController::class, 'updatePartial']);
Route::delete('/tarjetas/{id}', [TarjetaController::class, 'destroy']);






