@extends('layouts.admin')

@section('content')
        <!--面包屑配置项 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项列表
</div>
<!--面包屑配置项 结束-->

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

    <!--快捷配置项 开始-->
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置项</a>
        </div>
    </div>
    <!--快捷配置项 结束-->
</div>

<!--搜索结果页面 列表 开始-->

<div class="result_wrap">
    <div class="result_content">
        <form action="{{url('admin/config/changecontent')}}" method="get">
            {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th class="tc" width="10%">标题</th>
                    <th class="tc" width="10%">名称</th>
                    <th class="tc">内容</th>
                    <th class="tc" width="10%">操作</th>
                </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="text" onchange="orderDidChangeValue(this, {{$v->conf_id}});" value="{{$v->conf_order}}"></td>
                        <td class="tc">{{$v->conf_id}}</td>
                        <td class="tc"><a href="#">{{$v->conf_title}}</a></td>
                        <td class="tc">{{$v->conf_name}}</td>
                        <td class="tc"><input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">{!! $v->conf_html !!}</td>
                        <td class="tc"><a href="{{url('admin/config/' . $v->conf_id . '/edit')}}">修改</a><a href="javascript:;" onclick="deleteCate({{$v->conf_id}})">删除</a></td>
                    </tr>
                @endforeach

            </table>

            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>

        </form>

    </div>
</div>
<!--搜索结果页面 列表 结束-->

<script>
    function orderDidChangeValue(obj, conf_id) {
        var cate_order = $(obj).val();
        $.post("{{url('admin/config/changeorder')}}", {'_token' : '{{csrf_token()}}', 'conf_order' : cate_order, 'conf_id' : conf_id}, function(data) {
            if (data.status == 1) {
                layer.msg(data.msg, {icon: 6});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    function deleteCate(conf_id) {
        //询问框
        layer.confirm('您确定要删除这个配置项栏吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/config')}}/" + conf_id, {'_token' : '{{csrf_token()}}', '_method' : 'delete'}, function(data) {
                if (data.status == 1) {
                    layer.msg(data.msg, {icon: 6});
                } else {
                    layer.msg(data.msg, {icon: 5});
                }
                location.href = location.href;
            });
        }, function(){

        });
    }
</script>

@endsection