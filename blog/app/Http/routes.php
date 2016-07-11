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

// 登录
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    // 验证码
    Route::get('code', 'LoginController@code');

    // 登录
    Route::any('login', 'LoginController@login');
});

// 后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin.login']], function() {

    // 后台首页
    Route::get('index', 'IndexController@index');

    // 网站基本信息
    Route::get('info', 'IndexController@info');

    // 退出登录
    Route::get('logout', 'LoginController@logout');

    // 修改密码
    Route::any('pass', 'IndexController@modifyPassword');

    // 分类管理
    Route::resource('category', 'CategoryController');
    Route::post('category/changeorder', 'CategoryController@changeorder');

    // 文章管理
    Route::resource('article', 'ArticleController');

    // 上传图片
    Route::any('upload', 'CommonController@upload');

    // 友情链接
    Route::resource('links', 'LinksController');
    Route::post('links/changeorder', 'LinksController@changeorder');

    // 导航栏
    Route::resource('navs', 'NavsController');
    Route::post('navs/changeorder', 'NavsController@changeorder');

    // 网站配置
    Route::resource('config', 'ConfigController');
    Route::post('config/changeorder', 'ConfigController@changeorder');
    Route::post('config/changecontent', 'ConfigController@changecontent');

});

// 前台
Route::group(['namespace' => 'Home'], function() {
    Route::get('/', 'IndexController@index');
    Route::get('cate/{cate_id}', 'IndexController@cate');
    Route::get('news/{art_id}', 'IndexController@article');
});
