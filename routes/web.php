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

$router->group(['prefix' => '/api', 'middleware' => 'autenticador'], function () use ($router) {
    $router->post('/posts', 'Controller@store');
});
$router->group(['prefix' => '/api'], function () use ($router) {
    $router->get('/', 'Controller@welcome');
    $router->get('/posts/{id}', 'Controller@show');
    $router->get('/posts', 'Controller@index');
});

$router->post('/api/login', 'TokenController@gerarToken');