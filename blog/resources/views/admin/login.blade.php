@extends('layouts.admin', ['title' => '登录界面'])

@section('content')
	<div class="login_box">
		<h1>Blog</h1>
		<h2>个人博客管理系统</h2>
		<div class="form">
			@if(session('msg'))
				<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="#" method="post">
				{{csrf_field()}}
				<ul>
					<li>
						<input type="text" name="username" class="text" value="{{ old('username') }}"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text" value="{{ old('password') }}"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{ url('admin/code') }}" alt="" onclick="this.src='{{ url('admin/code') }}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p>CopyRight &copy; 2016 Powered by <a href="https://blog.6ag.cn" target="_blank">六阿哥</a></p>
		</div>
	</div>

@endsection