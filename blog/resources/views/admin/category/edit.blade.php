@extends('layouts.admin')

@section('content')

        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑分类
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>分类管理</h3>
        {{--错误提示信息--}}
        @if(is_object($errors) && count($errors) > 0)
            <div class="mark">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @elseif(is_string($errors))
            <div class="mark">
                <p>{{$errors}}</p>
            </div>
        @endif
    </div>

    <!--快捷导航 开始-->
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
            <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
        </div>
    </div>

                <!--快捷导航 结束-->
</div>

<div class="result_wrap">
    <form action="{{url('admin/category/' . $cate->cate_id)}}" method="post">
        {{csrf_field()}}
        {{--put提交方式,在这里添加一个隐藏域--}}
        <input type="hidden" value="put" name="_method">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==顶级分类==</option>
                        @foreach($data as $v)
                            <option value="{{$v->cate_id}}" {{$v->cate_id == $cate->cate_pid ? 'selected' : ''}}>{{$v->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text" name="cate_name" value="{{$cate->cate_name}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称为必填项</span>
                </td>
            </tr>

            <tr>
                <th>分类标题：</th>
                <td>
                    <input type="text" class="lg" name="cate_title" value="{{$cate->cate_title}}">
                </td>
            </tr>

            <tr>
                <th>关键词：</th>
                <td>
                    <input type="text" class="lg" name="cate_keywords" value="{{$cate->cate_keywords}}">
                </td>
            </tr>

            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="cate_description">{{$cate->cate_description}}</textarea>
                </td>
            </tr>

            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="cate_order" value="{{$cate->cate_order}}">
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>

            </tbody>
        </table>
    </form>
</div>

@endsection