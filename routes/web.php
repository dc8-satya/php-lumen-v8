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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('foo', function () {
    return 'Hello World';
});

$router->get('products', '\App\Http\Controllers\ProductController@index');
$router->post('product', '\App\Http\Controllers\ProductController@create');
$router->get('product/{id}', '\App\Http\Controllers\ProductController@show');
$router->put('product/{id}', '\App\Http\Controllers\ProductController@update');
$router->delete('product/{id}', '\App\Http\Controllers\ProductController@destroy');

