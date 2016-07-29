<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends BaseController
{
    public function index()
    {
        // 站长推荐 6篇浏览量最高的
        $pics = Article::orderBy('art_view', 'desc')->take(6)->get();

        // 图文列表
        $articleList = Article::orderBy('art_time', 'desc')->paginate(10);

        // 友情链接
        $links = Links::orderBy('link_order', 'asc')->get();

        return view('home.index', compact('pics', 'articleList', 'links'));
    }

    public function showCategoryList($cate_id)
    {
        $articleList = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(10);

        // 查看次数自增
        Category::where('cate_id', $cate_id)->increment('cate_view');

        // 当前分类
        $currentCategory = Category::find($cate_id);

        return view('home.list',compact('currentCategory', 'articleList'));
    }

    public function showArticleDetail($art_id)
    {
        // 当前文章
        $currentArticle = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->where('art_id', $art_id)->first();

        // 查看次数自增
        Article::where('art_id', $art_id)->increment('art_view');

        // 文章上一篇 下一篇
        $currentArticle['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id','desc')->first();
        $currentArticle['next'] = Article::where('art_id', '>', $art_id)->orderBy('art_id','asc')->first();
        
        // 相关文章
        $data = Article::where('cate_id',$currentArticle->cate_id)->orderBy('art_id','desc')->take(6)->get();

        return view('home.article', compact('currentArticle', 'data'));
    }
}
