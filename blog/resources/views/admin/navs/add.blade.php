@extends('layouts.admin')

@section('content')

        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加导航栏
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>分类管理</h3>
        {{--错误提示信息--}}
        @if(is_array($errors) && count($errors) > 0)
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
            <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加导航栏</a>
            <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部导航栏</a>
        </div>

    </div>
    <!--快捷导航 结束-->
</div>

<div class="result_wrap">
    <form action="{{url('admin/navs')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>

            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" name="nav_name" placeholder="中文名称"> <input type="text" name="nav_en" placeholder="英文名称">
                    <span><i class="fa fa-exclamation-circle yellow"></i>导航名称为必填项</span>
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>URL：</th>
                <td>
                    <input type="text" class="lg" name="nav_url" placeholder="导航栏连接">
                </td>
            </tr>

            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="nav_title" placeholder="导航栏描述不会显示到前台"></textarea>
                </td>
            </tr>

            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="nav_order" placeholder="导航栏排序">
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