<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    // get admin/category  全部分类列表
    public function index()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data', $data);
    }

    // get admin/category/create 添加分类
    public function create()
    {
        $data = Category::where('cate_pid', 0)->get();
        return view('admin.category.add', compact('data'));
    }

    // post admin/category 添加分类提交处理
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'cate_name' => 'required',
        ];

        $message = [
            'cate_name.required' => '分类名称不能为空',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $result = Category::create($input);
            if ($result) {
                return redirect('admin/category');
            } else {
                return back()->with('errors', '添加分类失败');
            }
        } else {
//            不知道这里为啥传过去没值
            return back()->withErrors($validator);
//            return back()->with('errors', '分类名称不能为空');
        }
    }

    // get admin/category/{category} 显示单个分类信息
    public function show()
    {

    }

    // put admin/category/{category} 更新分类
    public function update($cate_id)
    {
        $input = Input::except('_token', '_method');
        $result = Category::where('cate_id', $cate_id)->update($input);
        if ($result) {
            return redirect('admin/category');
        } else {
            return back()->with('errors', '更新分类失败');
        }

    }

    // get admin/category/{category}/edit 编辑分类
    public function edit($cate_id)
    {
        $cate = Category::find($cate_id);
        $data = Category::where('cate_pid', 0)->get();
        return view('admin/category/edit', compact('cate', 'data'));
    }

    // delete admin/category/{category} 删除分类
    public function destroy($cate_id)
    {
        $result = Category::where('cate_id', $cate_id)->delete();
        if ($result) {
            // 更新子分类
            Category::where('cate_pid', $cate_id)->update(['cate_pid' => 0]);
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

    // 排序改变
    public function changeorder()
    {
        $cate = Category::find(Input::get('cate_id'));
        $cate->cate_order = Input::get('cate_order');
        $result = $cate->update();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '更新分类排序成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '更新分类排序失败',
            ];
        }

        return $data;
    }
}
