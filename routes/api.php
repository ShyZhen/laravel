<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// show time
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    // no auth:api
    $api->group(['prefix' => 'v1', 'middleware' => 'cors', 'namespace' => 'App\Http\Controllers\Api\V1'], function($api) {
        $api->post('login', 'AuthController@login');
        $api->post('register-code', 'AuthController@registerCode');
        $api->post('register', 'AuthController@register');
        $api->post('password-code', 'AuthController@passwordCode');
        $api->post('password', 'AuthController@password');

        $api->get('posts', 'PostController@getAllPosts');
    });
    // need access_token
    $api->group(['prefix' => 'v1','middleware' => [ 'cors', 'auth:api'], 'namespace' => 'App\Http\Controllers\Api\V1'], function($api) {
        $api->get('me', 'AuthController@myInfo');
        $api->get('logout', 'AuthController@logout');

        $api->get('post/{uuid}', 'PostController@getPostById');
        $api->post('post', 'PostController@createPost');
        $api->put('post/{uuid}', 'PostController@updatePost');
    });
});



// for test
$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v2', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Api\V2'], function($api) {
        $api->get('test', 'TestController@test');
    });
    $api->group(['prefix' => 'test', 'namespace' => 'App\Http\Controllers\Api\V1'], function($api) {

    });
});