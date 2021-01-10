<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$router->post('user', '\App\Http\Controllers\UserController@create');
$router->post('user-login', '\App\Http\Controllers\UserController@authenticate');

$router->get('test', '\App\Http\Controllers\UserController@test');



$router->group(['prefix' => 'api/'], function ($router) {
    $router->post('todo', '\App\Http\Controllers\TodoController@create');
//    $app->get('login/','UsersController@authenticate');
//    $app->post('todo/','TodoController@store');
//    $app->get('todo/', 'TodoController@index');
//    $app->get('todo/{id}/', 'TodoController@show');
//    $app->put('todo/{id}/', 'TodoController@update');
//    $app->delete('todo/{id}/', 'TodoController@destroy');
});
