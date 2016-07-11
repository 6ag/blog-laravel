@extends('layouts.admin')

@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 系统基本信息
	</div>
	<!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>版本</label><span>v1.0.0</span>
                </li>
                <li>
                    <label>上传附件限制</label><span>{{get_cfg_var("upload_max_filesize") ? get_cfg_var("upload_max_filesize") : "不允许上传附件"}}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date('Y年m月d日 H时i分s秒')}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['HTTP_HOST']}} [{{$_SERVER['SERVER_ADDR']}}]</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['REMOTE_ADDR']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>作者博客：</label><span><a href="https://blog.6ag.cn">https://blog.6ag.cn</a></span>
                </li>
                <li>
                    <label>交流QQ群：</label><span>888888</span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

@endsection