<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

// Capturamos la solicitud
$request = Request::capture();

// Obtenemos la respuesta de la app
$response = $app->handle($request);

// Enviar la respuesta
$response->send();

// Terminamos la solicitud
$app->terminate($request, $response);
