<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\isUserAuth;
use App\Http\Middleware\isAdmin;
use App\Models\User;

// Rutas públicas
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para el controlador de estudiantes (reales de la base de datos)
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::patch('/students/{id}', [StudentController::class, 'updatePartial']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por autenticación de usuario
Route::middleware([isUserAuth::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    Route::get('students', [StudentController::class, 'index']);
});

// Rutas protegidas por autenticación de administrador
Route::middleware([isAdmin::class])->group(function () {
    Route::post('/users', [StudentController::class, 'getUsers']);
    Route::get('/users/{id}', [StudentController::class, 'getUser']);
    Route::put('/users/{id}', [StudentController::class, 'updateUser']);
    Route::delete('/users/{id}', [StudentController::class, 'deleteUser']);
    Route::get('/students', [StudentController::class, 'addStudent']);
    Route::get('/students/{id}', [StudentController::class, 'getStudent']);
});






//          --------------PRUEBAS -------------------

// Route::get('/students', function () {
//     return response('lista de estudiantessss', 200);
// });

//  Route::post('/students', function () { return 'Creating student'; });

//  Route::put('/students/{id}', function () { return 'Updating student';
// });

//  Route::delete('/students/{id}', function () { return 'Deleting
// student'; });

// Route::get('/students/{id}', function () { return 'Getting single
// student'; });
