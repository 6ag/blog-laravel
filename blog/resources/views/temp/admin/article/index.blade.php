@extends('layouts.admin')

@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>分类管理</h3>
    </div>
    <!--快捷导航 开始-->
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
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
                    <th class="tc" width="5%">ID</th>
                    <th class="tc">标题</th>
                    <th class="tc" width="5%">点击</th>
                    <th class="tc" width="10%">编辑</th>
                    <th class="tc" width="15%">发布时间</th>
                    <th class="tc" width="10%">操作</th>
                </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">{{$v->art_id}}</td>
                        <td class="tc"><a href="#">{{$v->art_title}}</a></td>
                        <td class="tc">{{$v->art_view}}</td>
                        <td class="tc">{{$v->art_editor}}</td>
                        <td class="tc">{{date('Y-m-d H:i:s', $v->art_time)}}</td>
                        <td class="tc"><a href="{{url('admin/article/' . $v->art_id . '/edit')}}">修改</a><a href="javascript:;" onclick="deleteCate({{$v->art_id}})">删除</a></td>
                    </tr>
                @endforeach

            </table>

            <style>
                .result_content ul li span {
                    font-size: 15px;
                    padding: 6px 12px;
                }
            </style>
            <div class="page_list" >
                {{$data->links()}}
            </div>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<script>

    function deleteCate(art_id) {
        //询问框
        layer.confirm('您确定要删除这篇文章吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/article')}}/" + art_id, {'_token' : '{{csrf_token()}}', '_method' : 'delete'}, function(data) {
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