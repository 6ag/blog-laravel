<?php

// 后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    // 无需登录session验证
    Route::group([], function() {
        Route::any('login', 'AuthenticateController@login')->name('admin.login');
    });

    // 需要登录session验证
    Route::group(['middleware' => ['admin.login']], function() {
        // 后台首页
        Route::get('index', 'IndexController@index')->name('admin.index');

        // 网站基本信息
        Route::get('info', 'IndexController@info')->name('admin.info');

        // 修改密码
        Route::any('pass', 'IndexController@modifyPassword')->name('admin.pass');

        // 退出登录
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        // 分类管理
        Route::resource('category', 'CategoryController');
        Route::post('category/changeorder', 'CategoryController@changeorder')->name('admin.category.changeorder');

        // 文章管理
        Route::resource('article', 'ArticleController');

        // 上传图片
        Route::any('upload', 'CommonController@upload')->name('admin.upload');

        // 友情链接
        Route::resource('links', 'LinksController');
        Route::post('links/changeorder', 'LinksController@changeorder')->name('admin.links.changeorder');

        // 导航栏
        Route::resource('navs', 'NavsController');
        Route::post('navs/changeorder', 'NavsController@changeorder')->name('admin.navs.changeorder');

        // 网站配置
        Route::resource('config', 'ConfigController');
        Route::post('config/changeorder', 'ConfigController@changeorder')->name('admin.config.changeorder');
        Route::post('config/changecontent', 'ConfigController@changecontent')->name('admin.config.changecontent');
    });
});

// 前台
Route::group(['namespace' => 'Home'], function() {

    // 首页
    Route::get('/', 'IndexController@index')->name('home.index');

    // 分类列表
    Route::get('category/{cate_id}', 'IndexController@showCategoryList')->name('home.category');

    // 内容页
    Route::get('article/{art_id}', 'IndexController@showArticleDetail')->name('home.article');
});
