@extends('layouts.admin')

@section('content')

        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑文章
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
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
        </div>

    </div>
    <!--快捷导航 结束-->
</div>

<div class="result_wrap">
    <form action="{{url('admin/article/' . $article->art_id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" value="put" name="_method">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>文章分类：</th>
                <td>
                    <select name="cate_id">
                        @foreach($data as $v)
                            <option value="{{$v->cate_id}}" {{$article->cate_id == $v->cate_id ? 'selected' : ''}}>{{$v->_cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title" value="{{$article->art_title}}">
                </td>
            </tr>
            <tr>
                <th>作者：</th>
                <td>
                    <input type="text" name="art_editor" value="{{$article->art_editor}}">
                </td>
            </tr>
            <tr>
                <th rowspan="2">缩略图：</th>
                <td>
                    <input type="text" size="50" name="art_thumb" value="{{$article->art_thumb}}">
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script src="{{url('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{url('org/uploadify/uploadify.css')}}">
                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : '{{csrf_token()}}'
                                },
                                'swf'      : '{{asset('org/uploadify/uploadify.swf')}}',
                                'uploader' : '{{url('admin/upload')}}',
                                'onUploadSuccess' : function(file, data, response) {
                                    $('input[name=art_thumb]').val(data);
                                    $('#art_thumb_img').attr('src','/'+data);
                                }
                            });
                        });

                    </script>
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{$article->art_thumb ? '/' . $article->art_thumb : ''}}" alt="" id="art_thumb_img" style="max-width: 300px; max-height: 200px;">
                </td>
            </tr>
            <tr>
                <th>文章关键词：</th>
                <td>
                    <input type="text" class="lg" name="art_tag" value="{{$article->art_tag}}">
                </td>
            </tr>
            <tr>
                <th>SEO关键词：</th>
                <td>
                    <input type="text" class="lg" name="art_keywords" value="{{$article->art_keywords}}">
                </td>
            </tr>
            <tr>
                <th>SEO描述：</th>
                <td>
                    <textarea name="art_description">{{$article->art_description}}</textarea>
                </td>
            </tr>
            <tr>
                <th>文章简介：</th>
                <td>
                    <textarea name="art_smalltext">{{$article->art_smalltext}}</textarea>
                </td>
            </tr>
            <tr>
                <th rowspan="2"><i class="require">*</i>文章内容：</th>
                <td>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="art_newstext" type="text/plain" style="width:100%; height:400px;">
                        {!! $article->art_newstext !!}
                    </script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                </td>
            </tr>
            <tr>
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