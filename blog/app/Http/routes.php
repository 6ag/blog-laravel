<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin.login']], function() {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::any('add', 'IndexController@add');
    Route::any('list', 'IndexController@articleList');
    Route::any('tab', 'IndexController@tab');
    Route::any('img', 'IndexController@img');
    Route::any('pass', 'IndexController@modifyPassword');
    
    Route::get('logout', 'LoginController@logout');

    Route::resource('category', 'CategoryController');
    Route::post('category/changeorder', 'CategoryController@changeorder');

    Route::resource('article', 'ArticleController');

});
