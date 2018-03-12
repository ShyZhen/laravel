<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::group(['namespace' => 'Admin'], function() {
   Route::get('index', 'AdminController@index');
   Route::get('hello', 'AdminController@hello');
});