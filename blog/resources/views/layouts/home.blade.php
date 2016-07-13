<!doctype html>
<html>
<head>
    <meta charset="utf-8">
@yield('info')
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{ asset('home/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/index.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
<header>
    <div id="logo"><a href="{{ url('/') }}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $v)<a href="{{ $v->nav_url }}"><span>{{ $v->nav_name }}</span><span class="en">{{ $v->nav_en }}</span></a>@endforeach
    </nav>
</header>

@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($new as $n)
        <li><a href="{{ url('article', $n->art_id) }}" title="{{ $n->art_title }}" target="_blank">{{ $n->art_title }}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hot as $h)
        <li><a href="{{ url('article', $h->art_id) }}" title="{{ $h->art_title }}" target="_blank">{{ $h->art_title }}</a></li>
        @endforeach
    </ul>
@show

<footer>
    {!! config('web.copyright') !!}
</footer>

<!--[if lt IE 9]>
<script src="{{ asset('home/js/modernizr.js') }}"></script>
<![endif]-->
</body>
</html>
