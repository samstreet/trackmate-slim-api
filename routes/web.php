<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/api/users/', 'UserController@index');
$app->post('/api/users/', 'UserController@store');
$app->get('/api/users/{user_id}', 'UserController@show');
$app->put('/api/users/{user_id}', 'UserController@update');
$app->delete('/api/users/{user_id}', 'UserController@destroy');

$app->post('/api/users/locations', 'UserLocationController@store');
$app->get('/api/users/{user_id}/locations', 'UserLocationController@all');
$app->get('/api/users/{user_id}/locations/{location_id}', 'UserLocationController@get');

// Request Access Tokens
$app->post('/oauth', function () use ($app) {
    return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
});