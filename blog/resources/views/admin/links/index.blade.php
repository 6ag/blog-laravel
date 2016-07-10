@extends('layouts.admin')

@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 友情链接列表
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>分类管理</h3>
    </div>
    <!--快捷导航 开始-->
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
            <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部友情链接</a>
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
                    <th class="tc" width="12%">名称</th>
                    <th class="tc">URL</th>
                    <th class="tc">说明</th>
                    <th class="tc" width="10%">操作</th>
                </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc"><input type="text" onchange="orderDidChangeValue(this, {{$v->link_id}});" name="ord[]" value="{{$v->link_order}}"></td>
                        <td class="tc">{{$v->link_id}}</td>
                        <td class="tc"><a href="#">{{$v->link_name}}</a></td>
                        <td class="tc">{{$v->link_url}}</td>
                        <td class="tc">{{$v->link_title}}</td>
                        <td class="tc"><a href="{{url('admin/links/' . $v->link_id . '/edit')}}">修改</a><a href="javascript:;" onclick="deleteCate({{$v->link_id}})">删除</a></td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<script>
    function orderDidChangeValue(obj, link_id) {
        var cate_order = $(obj).val();
        $.post("{{url('admin/links/changeorder')}}", {'_token' : '{{csrf_token()}}', 'link_order' : cate_order, 'link_id' : link_id}, function(data) {
            if (data.status == 1) {
                layer.msg(data.msg, {icon: 6});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    function deleteCate(link_id) {
        //询问框
        layer.confirm('您确定要删除这个友情链接吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/links')}}/" + link_id, {'_token' : '{{csrf_token()}}', '_method' : 'delete'}, function(data) {
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