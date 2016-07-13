<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        // 导航
        $navs = Navs::all();
        View::share('navs',$navs);

        // 最新发布文章8篇
        $new = Article::orderBy('art_time', 'desc')->take(8)->get();
        View::share('new',$new);
        
        // 点击量最高的6篇文章
        $hot = Article::orderBy('art_view', 'desc')->take(5)->get();
        View::share('hot',$hot);
    }
}
