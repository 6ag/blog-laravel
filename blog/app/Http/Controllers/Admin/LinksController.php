<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    // get admin/links/{links} 显示单个友情链接信息
    public function show()
    {

    }

    // get admin/links  全部友情链接列表
    public function index()
    {
        $data = Links::orderBy('link_order', 'asc')->get();
        return view('admin.links.index')->with('data', $data);
    }

    // get admin/links/create 添加友情链接
    public function create()
    {
        return view('admin.links.add');
    }

    // post admin/links 添加友情链接提交处理
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];

        $message = [
            'link_name.required' => '友情链接名称不能为空',
            'link_url.required' => '友情链接URL不能为空',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $result = Links::create($input);
            if ($result) {
                return redirect()->route('admin.links.index');
            } else {
                return back()->with('errors', '添加友情链接失败');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    // get admin/links/{links}/edit 编辑友情链接
    public function edit($link_id)
    {
        $link = Links::find($link_id);
        $data = [];
        return view('admin/links/edit', compact('link', 'data'));
    }

    // put admin/links/{links} 更新友情链接
    public function update($link_id)
    {
        $input = Input::except('_token', '_method');
        $result = Links::where('link_id', $link_id)->update($input);
        if ($result) {
            return redirect()->route('admin.links.index');
        } else {
            return back()->with('errors', '更新友情链接失败');
        }

    }

    // delete admin/links/{links} 删除友情链接
    public function destroy($link_id)
    {
        $result = Links::where('link_id', $link_id)->delete();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '删除友情链接成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除分类失败',
            ];
        }

        return $data;
    }

    // 排序改变
    public function changeorder()
    {
        $link = Links::find(Input::get('link_id'));
        $link->link_order = Input::get('link_order');
        $result = $link->update();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '更新友情链接排序成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '更新友情链接排序失败',
            ];
        }

        return $data;
    }
}
