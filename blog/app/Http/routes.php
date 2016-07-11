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

// 后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    // 无需登录session验证
    Route::group([], function() {
        // 登录
        Route::any('login', ['as' => 'admin.login', 'uses' => 'LoginController@login']);

        // 验证码
        Route::get('code', ['as' => 'admin.code', 'uses' => 'LoginController@code']);
    });

    // 需要登录session验证
    Route::group(['middleware' => ['admin.login']], function() {
        // 后台首页
        Route::get('index', ['as' => 'admin.index', 'uses' => 'IndexController@index']);

        // 网站基本信息
        Route::get('info', ['as' => 'admin.info', 'uses' => 'IndexController@info']);

        // 修改密码
        Route::any('pass', ['as' => 'admin.pass', 'uses' => 'IndexController@modifyPassword']);

        // 退出登录
        Route::get('logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

        // 分类管理
        Route::resource('category', 'CategoryController');
        Route::post('category/changeorder', ['as' => 'admin.category.changeorder', 'uses' => 'CategoryController@changeorder']);

        // 文章管理
        Route::resource('article', 'ArticleController');

        // 上传图片
        Route::any('upload', ['as' => 'admin.upload', 'uses' => 'CommonController@upload']);

        // 友情链接
        Route::resource('links', 'LinksController');
        Route::post('links/changeorder', ['as' => 'admin.links.changeorder', 'uses' => 'LinksController@changeorder']);

        // 导航栏
        Route::resource('navs', 'NavsController');
        Route::post('navs/changeorder', ['as' => 'admin.navs.changeorder', 'uses' => 'NavsController@changeorder']);

        // 网站配置
        Route::resource('config', 'ConfigController');
        Route::post('config/changeorder', ['as' => 'admin.config.changeorder', 'uses' => 'ConfigController@changeorder']);
        Route::post('config/changecontent', ['as' => 'admin.config.changecontent', 'uses' => 'ConfigController@changecontent']);
    });
});

// 前台
Route::group(['namespace' => 'Home'], function() {

    // 首页
    Route::get('/', ['as' => 'home.index', 'uses' => 'IndexController@index']);

    // 分类列表
    Route::get('cate/{cate_id}', ['as' => 'home.cate', 'uses' => 'IndexController@cate']);

    // 内容页
    Route::get('news/{art_id}', ['as' => 'home.news', 'uses' => 'IndexController@article']);
});