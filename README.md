# Examen M7 de API 


Lo primero que debemos hacer es crear un entorno virtual para instalar las dependencias necesarias. Para ello, ejecutamos el siguiente comando:



## Objetivo del examen

El objetivo de este examen es crear una API RESTful utilizando Mysql y hacer endpoints sobre animales, tambien gestionar el inicio de sesión y el registro de usuarios, con su respectivos roles como admin y usuario.


## Admin contraseña del Proyecto 

- Albert@gmail.com

- contraseña: 132456


## Proteccion de las rutas

- IsAutenticated: Es un middleware que se encarga de verificar si el usuario está autenticado. 

- IsAdmin: Es un middleware que se encarga de verificar si el usuario es un administrador.


## Las rutas que se encuentran protegidas son las siguientes:

- Rutas publicas
POST   /register          
POST   /login            


- Rutas protegidas con autenticacion
GET    /pets               
POST   /pets              
GET    /my-pets          
GET    /pets/{id}          
PUT    /pets/{id}          
PATCH  /pets/{id}          
DELETE /pets/{id}       
POST   /logout             


- Rutas protegidas con admin
GET    /users          
GET    /users/{id}       
PUT    /users/{id}         
DELETE /users/{id}         




## Resumen de los Endpoints


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsUserAdmin;


//Rutas publicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Rutas protegidas
Route::middleware([IsAuthenticated::class])->group(function () {
Route::get('/pets', [PetController::class, 'index']);
Route::post('/pets', [PetController::class, 'store']);
Route::get('/my-pets', [PetController::class, 'myPets']);
Route::get('/pets/{id}', [PetController::class, 'show']);
Route::put('/pets/{id}', [PetController::class, 'update']);
Route::patch('/pets/{id}', [PetController::class, 'updatePartial']);
Route::delete('/pets/{id}', [PetController::class, 'destroy']);
Route::post('/logout', [AuthController::class, 'logout']);

});


Route::middleware([IsUserAdmin::class])->group(function () {
Route::get('/users', [AuthController::class, 'all']);
Route::get('/users/{id}', [AuthController::class, 'getUserById']);
Route::put('/users/{id}', [AuthController::class, 'updateUser']);
Route::delete('/users/{id}', [AuthController::class, 'adminDestroy']);






});


## Notas: 

Estaba mas confuso y complicao de lo que pensaba, pero hice todo lo que pude
