@extends('layouts.admin')

@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 分类列表
</div>
<!--面包屑导航 结束-->

{{--<!--结果页快捷搜索框 开始-->--}}
{{--<div class="search_wrap">--}}
{{--<form action="" method="post">--}}
{{--<table class="search_tab">--}}
{{--<tr>--}}
{{--<th width="120">选择分类:</th>--}}
{{--<td>--}}
{{--<select onchange="javascript:location.href=this.value;">--}}
{{--<option value="">全部</option>--}}
{{--<option value="http://www.baidu.com">百度</option>--}}
{{--<option value="http://www.sina.com">新浪</option>--}}
{{--</select>--}}
{{--</td>--}}
{{--<th width="70">关键字:</th>--}}
{{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
{{--<td><input type="submit" name="sub" value="查询"></td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</form>--}}
{{--</div>--}}
{{--<!--结果页快捷搜索框 结束-->--}}

<div class="result_wrap">
    <div class="result_title">
        <h3>分类管理</h3>
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

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    {{csrf_field()}}

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%"><input type="checkbox" name=""></th>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th class="tc" width="12%">分类名称</th>
                    <th class="tc">标题</th>
                    <th class="tc" width="5%">查看次数</th>
                    <th class="tc" width="10%">操作</th>
                </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc"><input type="text" onchange="orderDidChangeValue(this, {{$v->cate_id}});" name="ord[]" value="{{$v->cate_order}}"></td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td class="tc"><a href="#">{{$v->_cate_name}}</a></td>
                        <td class="tc">{{$v->cate_title}}</td>
                        <td class="tc">{{$v->cate_view}}</td>
                        <td class="tc"><a href="{{url('admin/category/' . $v->cate_id . '/edit')}}">修改</a><a href="javascript:;" onclick="deleteCate({{$v->cate_id}})">删除</a></td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<script>
    function orderDidChangeValue(obj, cate_id) {
        var cate_order = $(obj).val();
        $.post("{{url('admin/category/changeorder')}}", {'_token' : '{{csrf_token()}}', 'cate_order' : cate_order, 'cate_id' : cate_id}, function(data) {
            if (data.status == 1) {
                layer.msg(data.msg, {icon: 6});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    function deleteCate(cate_id) {
        //询问框
        layer.confirm('您确定要删除这个分类吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/category')}}/" + cate_id, {'_token' : '{{csrf_token()}}', '_method' : 'delete'}, function(data) {
                if (data.status == 1) {
                    layer.msg(data.msg, {icon: 6});
                } else {
                    layer.msg(data.msg, {icon: 5});
                }
                window.location.reload();
            });
        }, function(){

        });
    }
</script>

@endsection