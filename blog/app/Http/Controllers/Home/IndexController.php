<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
        // 站长推荐 6篇浏览量最高的
        $pics = Article::orderBy('art_view', 'desc')->take(6)->get();

        // 图文列表 5篇 分页
        $data = Article::orderBy('art_time', 'desc')->paginate(5);

        // 友情链接
        $links = Links::orderBy('link_order', 'asc')->get();

        return view('home.index', compact('pics', 'data', 'links'));
    }

    public function cate($cate_id)
    {
        // 图文列表4篇（带分页）
        $data = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(4);

        // 查看次数自增
        Category::where('cate_id', $cate_id)->increment('cate_view');

        // 当前分类的子分类
        $submenu = Category::where('cate_pid', $cate_id)->get();

        // 当前分类
        $field = Category::find($cate_id);
        return view('home.list',compact('field', 'data', 'submenu'));
    }

    public function article($art_id)
    {
        // 当前文章
        $field = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->where('art_id', $art_id)->first();

        // 查看次数自增
        Article::where('art_id', $art_id)->increment('art_view');

        // 文章上一篇 下一篇
        $article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id', '>', $art_id)->orderBy('art_id','asc')->first();

//        $article['pre'] = Article::where('art_id', '<', $art_id)->max('art_id');
//        $article['next'] = Article::where('art_id', '>', $art_id)->min('art_id');

        // 相关文章
        $data = Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();
        
        return view('home.news', compact('field', 'article', 'data'));
    }
}
