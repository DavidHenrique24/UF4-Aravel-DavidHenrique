<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\isUserAuth;
use App\Http\Middleware\isAdmin;
use App\Models\User;

// Rutas públicas
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
