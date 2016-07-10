@extends('layouts.admin')

@section('content')

        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加配置项
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>配置项管理</h3>
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
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置项</a>
        </div>

    </div>
    <!--快捷导航 结束-->
</div>

<div class="result_wrap">
    <form action="{{url('admin/config')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>

            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" class="md" name="conf_title" placeholder="配置项标题">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题为必填项 例如:网站域名</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" class="md" name="conf_name" placeholder="配置项名称">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称为必填项 例如:website_url</span>
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>类型：</th>
                <td>
                    <input type="radio" name="field_type" value="input" id="input" checked onclick="didClickedFieldType()"><label for="input">input</label>
                    <input type="radio" name="field_type" value="textarea" id="textarea" onclick="didClickedFieldType()"><label for="textarea">textarea</label>
                    <input type="radio" name="field_type" value="radio" id="radio" onclick="didClickedFieldType()"><label for="radio">radio</label>
                </td>
            </tr>

            <tr class="field_value">
                <th><i class="require">*</i>类型值：</th>
                <td>
                    <input class="lg" type="text" name="field_value" placeholder="格式1|开启 0|关闭">
                    <p><i class="fa"></i>类型值只有在radio的情况下才需要配置 格式1|开启 0|关闭</p>
                </td>
            </tr>

            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="conf_tips" placeholder="配置项描述不会显示到前台"></textarea>
                </td>
            </tr>

            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="conf_order" placeholder="配置项排序">
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

<script>
    didClickedFieldType();
    function didClickedFieldType() {
        var type = $('input[name=field_type]:checked').val();
        if (type == 'radio') {
            $('.field_value').show();
        } else {
            $('.field_value').hide();
        }
    }
</script>

@endsection