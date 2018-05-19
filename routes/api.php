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
//$api = app('Dingo\Api\Routing\Router');
//$api->version('v1', function ($api) {
//    $api->group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function($api) {
//        $api->get('test', 'TestController@test');
//    });
//});
//
//
//$api->version('v1', function ($api) {
//    $api->group(['prefix' => 'v2', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Api\V2'], function($api) {
//        $api->get('test', 'TestController@test');
//    });
//});