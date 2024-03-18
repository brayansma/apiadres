<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/* use App\Http\Controllers\AdquisicionController;
use Illuminate\Support\Facades\Route; */

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// Rutas para Unidad
/* $router->get('/unidades', 'UnidadController@index');
$router->get('/unidades/{id}', 'UnidadController@show');
$router->post('/unidades', 'UnidadController@store');
$router->put('/unidades/{id}', 'UnidadController@update');
$router->delete('/unidades/{id}', 'UnidadController@destroy');
$router->patch('unidades/{id}/restore', 'UnidadController@restore'); */

// Rutas para Unidad
$router->group(['prefix' => 'unidades'], function () use ($router) {
    $router->get('/', 'UnidadController@index');
    $router->get('/{id}', 'UnidadController@show');
    $router->post('/', 'UnidadController@store');
    $router->put('/{id}', 'UnidadController@update');
    $router->delete('/{id}', 'UnidadController@destroy');
    $router->patch('/{id}/restore', 'UnidadController@restore');
});

// Rutas para tipos
$router->group(['prefix' => 'tipos'], function () use ($router) {
    $router->get('/', 'TipoController@index');
    $router->get('/{id}', 'TipoController@show');
    $router->post('/', 'TipoController@store');
    $router->put('/{id}', 'TipoController@update');
    $router->delete('/{id}', 'TipoController@destroy');
    $router->patch('/{id}/restore', 'TipoController@restore');
});

// Define las rutas para los proveedores
$router->group(['prefix' => 'proveedores'], function () use ($router) {
    $router->get('/', 'ProveedorController@index'); 
    $router->get('/{id}', 'ProveedorController@show'); 
    $router->post('/', 'ProveedorController@store'); 
    $router->put('/{id}', 'ProveedorController@update'); 
    $router->delete('/{id}', 'ProveedorController@destroy'); 
    $router->patch('/{id}/restore', 'ProveedorController@restore'); 
});

// Define las rutas para los proveedores
$router->group(['prefix' => 'adquisiciones'], function () use ($router) {
    $router->get('/', 'AdquisicionController@index'); 
    $router->get('/{id}', 'AdquisicionController@show'); 
    $router->post('/', 'AdquisicionController@store'); 
    $router->put('/{id}', 'AdquisicionController@update'); 
    $router->delete('/{id}', 'AdquisicionController@destroy'); 
    $router->patch('/{id}/restore', 'AdquisicionController@restore'); 
});


/* Route::get('/adquisiciones', [AdquisicionController::class, 'index']);
Route::get('/adquisiciones/{id}', [AdquisicionController::class, 'show']);
Route::post('/adquisiciones', [AdquisicionController::class, 'store']);
Route::put('/adquisiciones/{id}', [AdquisicionController::class, 'update']);
Route::patch('/adquisiciones/{id}', [AdquisicionController::class, 'restore']); 
Route::delete('/adquisiciones/{id}', [AdquisicionController::class, 'destroy']);
 */
