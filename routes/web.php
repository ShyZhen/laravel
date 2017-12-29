<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Home'], function() {
   Route::get('attempt', 'WelcomeController@attempt');
   Route::get('auth', 'WelcomeController@authUser');
   Route::get('logout', 'WelcomeController@logout');
   Route::get('index', 'WelcomeController@index');
   Route::get('getCache', 'WelcomeController@getCache');
   Route::get('putCache', 'WelcomeController@putCache');
   Route::get('getRedis', 'WelcomeController@getRedis');
   Route::get('putRedis', 'WelcomeController@putRedis');
});

Route::group(['prefix' => 'route', 'namespace' => 'Home', 'middleware' => ['web', 'auth', 'test']], function() {
    Route::get('hello', 'HttpController@index')->name('he');    //  命名路由，方便生成重定向
    Route::get('param/{personal_id}/{course_id}','HttpController@param')->where(['personal_id' => '[0-9]+', 'course_id' => '[0-9]+']);
    Route::get('redirect','HttpController@redirect');
    Route::get('model', 'HttpController@model');
});