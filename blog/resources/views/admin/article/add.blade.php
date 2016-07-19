@extends('layouts.admin')

@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_title">
            <h3>分类管理</h3>
            {{--错误提示信息--}}
            @if(is_object($errors) && count($errors) > 0)
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @elseif(is_string($errors))
                <div class="mark">
                    <p>{{ $errors }}</p>
                </div>
            @endif
        </div>

        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{ url('admin/article/create') }}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{ url('admin/article') }}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>

        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <form action="{{ url('admin/article') }}" method="post">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                <tr>
                    <td>
                        <select name="cate_id" class="form-control">
                            @foreach($data as $v)
                                <option value="{{ $v->cate_id }}">{{ $v->_cate_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="lg" name="art_title" placeholder="文章标题">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="art_editor" placeholder="作者">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" size="50" name="art_thumb" placeholder="缩略图">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{ url('org/uploadify/jquery.uploadify.min.js') }}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{ url('org/uploadify/uploadify.css') }}">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText' : '图片上传',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : '{{csrf_token()}}'
                                    },
                                    'swf'      : '{{ asset('org/uploadify/uploadify.swf') }}',
                                    'uploader' : '{{ url('admin/upload') }}',
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
                        <img src="" alt="" id="art_thumb_img" style="max-width: 300px; max-height: 200px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="lg" name="art_tag" placeholder="文章关键词 多个以 , 分割">
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="art_smalltext" placeholder="文章简介"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <link rel="stylesheet" href="{{ url('org/editor/css/editormd.min.css') }}" />
                        <div id="editormd">
                            <textarea name="art_newstext" style="display:none;"></textarea>
                        </div>
                        <script src="{{ url('org/editor/editormd.min.js') }}"></script>
                        <script type="text/javascript">
                            $(function() {
                                var testEditor;

                                $.get('test.md', function(md){
                                    testEditor = editormd("editormd", {
                                        width: "100%",
                                        height: 700,
                                        path : "{{ url('org/editor/lib').'/' }}",
                                        markdown : md,
                                        codeFold : true,
                                        saveHTMLToTextarea : true,
                                        searchReplace : true,
                                        htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                                        //toolbar  : false,             //关闭工具栏
                                        emoji : true,
                                        taskList : true,
                                        tocm            : true,         // Using [TOCM]
                                        tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                                        flowChart : true,             // 开启流程图支持，默认关闭
                                        sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                                        //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                                        //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                                        //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                                        //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                                        //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                                        imageUpload : true,
                                        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                                        imageUploadURL : "./php/upload.php",
                                        onload : function() {
//                                            console.log('onload', this);
                                        }
                                    });
                                });

                            });
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