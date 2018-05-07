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

   Route::get('index', 'WelcomeController@index');
   Route::get('getCache', 'WelcomeController@getCache');
   Route::get('putCache', 'WelcomeController@putCache');
   Route::get('getRedis', 'WelcomeController@getRedis');
   Route::get('putRedis', 'WelcomeController@putRedis');

   Route::get('csrf', 'WelcomeController@csrf');

   Route::resource('restful','RestfulController');
});

Route::group(['prefix' => 'route', 'namespace' => 'Home', 'middleware' => ['web', 'auth', 'test']], function() {
    Route::get('hello', 'HttpController@index')->name('he');    //  命名路由，方便生成重定向
    Route::get('param/{personal_id}/{course_id}','HttpController@param')->where(['personal_id' => '[0-9]+', 'course_id' => '[0-9]+']);
    Route::get('redirect','HttpController@redirect');
    Route::get('model', 'HttpController@model');
    Route::get('flash', 'HttpController@flashTest');
    Route::get('getsession', 'HttpController@getSession');
    Route::get('getcoolie', 'HttpController@getCoolie');
    Route::any('upload', 'HttpController@upload');
});

Route::group(['prefix' => 'response', 'namespace' => 'Home'], function() {
   Route::get('index', 'ResponseController@index');
   Route::get('hello', function() {
       return 'hello world';
   });
    Route::get('/json', function() {
        return [1,2,3];
    });
    Route::get('home', function() {
        return response('Hellddo World', 202)->header('Content-Type', 'text/plain');
    });
    Route::get('home2', 'ResponseController@home2');

    Route::get('cookie', 'ResponseController@cookie');
    Route::get('cookie/{cookieName}', 'ResponseController@getCookie');

    Route::get('dashboard', function () {
        return redirect('csrf');
    });

    Route::get('dash', 'ResponseController@dashboard');
    Route::get('laracasts', 'ResponseController@laracasts');
    Route::get('laracasts2', 'ResponseController@laracasts2');

    Route::get('toastr', 'ResponseController@toastr');

    Route::get('download', 'ResponseController@download');
});

Route::group(['prefix' => 'session', 'namespace' => 'Home'], function() {
    Route::get('/', 'SessionController@index');
    Route::get('all', 'SessionController@all');
    Route::get('getSession', 'SessionController@getSession');
    Route::get('setSession', 'SessionController@setSession');
});

//    validatesTestController  表单验证
Route::group(['prefix' => 'valida', 'namespace' => 'Home'], function () {
    Route::get('/', 'ValidateTestController@index');
    Route::get('post/create', 'ValidateTestController@create');
    Route::post('post/create', 'ValidateTestController@store');
});

Route::group(['namespace' => 'Home'], function () {
    Route::get('/comment', 'CommentController@getAllComments');
//    Route::get('/user', 'CommentController@getUserName');
});

Route::group(['namespace' => 'Home', 'prefix' => 'view'], function() {
   Route::get('/', 'ViewController@index');
   Route::get('/test1', 'ViewController@test1');
   Route::get('/test2', 'ViewController@test2');
   Route::get('/css', 'ViewController@css');
});


// test over;

Route::group(['namespace' => 'Home', 'prefix' => 'auth'], function() {
    Route::get('/', 'WelcomeController@authUser');
    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/register', 'AuthController@register');
    Route::post('/register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['namespace' => 'Home', 'prefix' => 'home', 'middleware' => ['web', 'home.auth']], function() {
   Route::get('/index', 'IndexController@index');
   Route::get('/user/{user}', 'IndexController@userInfo');
});