<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    // get admin/navs/{navs} 显示单个导航信息
    public function show()
    {
        
    }

    // get admin/navs  全部导航列表
    public function index()
    {
        $data = Navs::orderBy('nav_order', 'asc')->get();
        return view('admin.navs.index')->with('data', $data);
    }

    // get admin/navs/create 添加导航
    public function create()
    {
        return view('admin.navs.add');
    }

    // post admin/navs 添加导航提交处理
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];

        $message = [
            'nav_name.required' => '导航名称不能为空',
            'nav_url.required' => '导航URL不能为空',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $result = Navs::create($input);
            if ($result) {
                return redirect('admin/navs');
            } else {
                return back()->with('errors', '添加导航失败');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    // get admin/navs/{navs}/edit 编辑导航
    public function edit($nav_id)
    {
        $nav = Navs::find($nav_id);
        $data = [];
        return view('admin/navs/edit', compact('nav', 'data'));
    }

    // put admin/navs/{navs} 更新导航
    public function update($nav_id)
    {
        $input = Input::except('_token', '_method');
        $result = Navs::where('nav_id', $nav_id)->update($input);
        if ($result) {
            return redirect('admin/navs');
        } else {
            return back()->with('errors', '更新导航失败');
        }

    }

    // delete admin/navs/{navs} 删除导航
    public function destroy($nav_id)
    {
        $result = Navs::where('nav_id', $nav_id)->delete();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '删除导航成功',
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
        $nav = Navs::find(Input::get('nav_id'));
        $nav->nav_order = Input::get('nav_order');
        $result = $nav->update();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '更新导航排序成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '更新导航排序失败',
            ];
        }

        return $data;
    }
}
