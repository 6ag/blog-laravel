<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Model\Navs;
use App\Http\Model\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        view()->composer(['layouts.home', 'home.index', 'home.category', 'home.article'], function($view) {

            // 导航数据
            $navs = Navs::all();

            $categories = Category::all();

            // 最新发布文章8篇
            $new = Article::orderBy('art_time', 'desc')->take(8)->get();

            // 点击量最高的6篇文章
            $hot = Article::orderBy('art_view', 'desc')->take(5)->get();

            $view->with(['navs' => $navs, 'new' => $new, 'hot' => $hot, 'categories' => $categories]);



        });
    }
}