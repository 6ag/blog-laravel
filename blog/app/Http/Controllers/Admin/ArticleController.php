<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    // get admin/article  全部文章列表
    public function index()
    {
        $data = Article::orderBy('art_id', 'desc')->paginate(10);
        return view('admin.article.index', compact('data'));
    }

    // get admin/article/create 添加文章
    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add', compact('data'));
    }

    // post admin/article 添加文章提交处理
    public function store()
    {
        $input = Input::except('_token');
        $input['art_time'] = time();
        $rules = [
            'art_title' => 'required',
            'art_newstext' => 'required',
        ];
        $message = [
            'art_title.required' => '文章标题不能为空',
            'art_newstext' => '文章内容不能为空',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->passes()) {
            Article::create($input);
            return redirect('admin/article');
        } else {
            // 有问题,返回数据不能接收到
//            return back()->withErrors($validator);
            return back()->with('errors', '必填项不能为空');
        }
    }

    // get admin/article/{article} 显示单个文章信息
    public function show()
    {

    }

    // put admin/article/{article} 更新文章
    public function update($art_id)
    {
        $input = Input::except('_token', '_method');
        $result = Article::where('art_id', $art_id)->update($input);
        if ($result) {
            return redirect('admin/article');
        } else {
            return back()->with('errors', '文章更新失败,请稍后重试');
        }
    }

    // get admin/article/{article}/edit 编辑文章
    public function edit($art_id)
    {
        $data = (new Category)->tree();
        $article = Article::find($art_id);
        return view('admin/article/edit', compact('data', 'article'));
    }

    // delete admin/article/{article} 删除文章
    public function destroy($art_id)
    {
        $result = Article::where('art_id', $art_id)->delete();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '删除分类成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除分类失败',
            ];
        }

        return $data;
    }
}
