<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
    // get admin/article  全部文章列表
    public function index()
    {
        $data = [];
        return view('admin.article.index')->with('data', $data);
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
        dd(Input::all());
    }

    // get admin/article/{article} 显示单个文章信息
    public function show()
    {

    }

    // put admin/article/{article} 更新文章
    public function update($art_id)
    {

    }

    // get admin/article/{article}/edit 编辑文章
    public function edit($art_id)
    {

    }

    // delete admin/article/{article} 删除文章
    public function destroy($art_id)
    {

    }
}
