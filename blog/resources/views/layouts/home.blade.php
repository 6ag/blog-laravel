<!DOCTYPE HTML>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>@section('title'){{ config('web.website_title') }} - {{ config('web.website_subtitle') }}@show</title>
    <meta name="keywords" content="@section('keywords'){{ config('web.website_keywords') }}@show">
    <meta name="description" content="@section('description'){{ config('web.website_description') }}@show">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta name="author" content="六阿哥">
    <link rel="alternative" href="#" title="六阿哥博客" type="application/atom+xml">
    <link rel="icon" href=" {{ url('home/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ url('home/css/style.css') }}" type="text/css">
</head>

<body>
<header>
    <div>
        <div id="textlogo">
            <h1 class="site-name"><a href="/" title="六阿哥博客">六阿哥博客</a></h1>
            <h2 class="blog-motto">记录一个iOS程序员的成长历程</h2>
        </div>
        <div class="navbar"><a class="navbutton navmobile" href="#" title="菜单">
            </a></div>
        <nav class="animated">
            <ul>

                <li><a href="{{ url('/') }}">首页</a></li>
                <li><a href="{{ url('archives') }}">归档</a></li>
                <li><a href="{{ url('about') }}">关于</a></li>

                <li>
                    <form class="search" action="#" method="get" accept-charset="utf-8">
                        <label>Search</label>
                        <input type="search" id="search" name="q" autocomplete="off" maxlength="20" placeholder="搜索" />
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div id="container">

    @yield('content')

    <div class="openaside"><a class="navbutton" href="#" title="显示侧边栏"></a></div>
    <div id="asidepart">
        <div class="closeaside"><a class="closebutton" href="#" title="隐藏侧边栏"></a></div>
        <aside class="clearfix">

            <div class="categorieslist">
                <p class="asidetitle">分类</p>
                <ul>
                    @foreach($categories as $category)
                    <li><a href="{{ url('category', $category->cate_id) }}" title="{{ $category->cate_name }}">{{ $category->cate_name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="weixin">
                <br />
                <p class="asidetitle">微信公众号</p>
                <p>关注唐巧的「iOS开发」公众号，获得精选的 iOS 开发文章和创业心得：</p>
                <img src="http://ww4.sinaimg.cn/mw690/65dc76a3jw1f1ngaau9arj20760763yr.jpg" width="230px" />
            </div>

            <div class="rsspart">
                <a href="#" target="_blank" title="rss">RSS 订阅</a>
            </div>

            @yield('links')

        </aside>
    </div>
</div>

<footer>
    <div id="footer" >
        <div class="social-font" class="clearfix">
        </div>
        <p class="copyright" style="margin-top: 10px;">
            Copyright © 2016 System By <a href="{{ url('about') }}" target="_blank" title="六阿哥">六阿哥</a> and Templete by <a href="https://github.com/wuchong/jacman" target="_blank" title="Jacman">Jacman</a>
        </p>
    </div>
</footer>

<script src="{{ url('home/js/jquery-2.0.3.min.js') }}"></script>
<script src="{{ url('home/js/jquery.imagesloaded.min.js') }}"></script>
<script src="{{ url('home/js/gallery.js') }}"></script>
<script src="{{ url('home/js/jquery.qrcode-0.12.0.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.navbar').click(function(){
            $('header nav').toggleClass('shownav');
        });
        var myWidth = 0;
        function getSize(){
            if( typeof( window.innerWidth ) == 'number' ) {
                myWidth = window.innerWidth;
            } else if( document.documentElement && document.documentElement.clientWidth) {
                myWidth = document.documentElement.clientWidth;
            };
        };
        var m = $('#main'),
                a = $('#asidepart'),
                c = $('.closeaside'),
                o = $('.openaside');
        c.click(function(){
            a.addClass('fadeOut').css('display', 'none');
            o.css('display', 'block').addClass('fadeIn');
            m.addClass('moveMain');
        });
        o.click(function(){
            o.css('display', 'none').removeClass('beforeFadeIn');
            a.css('display', 'block').removeClass('fadeOut').addClass('fadeIn');
            m.removeClass('moveMain');
        });
        $(window).scroll(function(){
            o.css("top",Math.max(80,260-$(this).scrollTop()));
        });

        $(window).resize(function(){
            getSize();
            if (myWidth >= 1024) {
                $('header nav').removeClass('shownav');
            }else{
                m.removeClass('moveMain');
                a.css('display', 'block').removeClass('fadeOut');
                o.css('display', 'none');

            }
        });
    });
</script>

<!-- Analytics Begin -->
<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-28029597-1', 'null');
    ga('send', 'pageview');
</script>
<!-- Analytics End -->

<!-- Totop Begin -->
<div id="totop">
    <a title="返回顶部"><img src="{{ url('home/img/scrollup.png') }}"/></a>
</div>
<script src="{{ url('home/js/totop.js') }}"></script>
<!-- Totop End -->

</body>
</html>