@extends('layouts.home')

@section('content')
    <div id="main">

        @foreach($articleList as $article)
            <section class="post" itemscope itemprop="blogitem">
                <a href="{{ url('article', $article->art_id) }}" title="{{ $article->art_title }}" itemprop="url">
                    <h1 itemprop="name">{{ $article->art_title }}</h1>
                    <p itemprop="description" >{{ $article->art_smalltext }}</p>
                    <time datetime="{{ date('Y-m-d', $article->art_time) }}" itemprop="datePublished">{{ date('Y-m-d', $article->art_time) }}</time>
                </a>
            </section>
        @endforeach

        <nav id="page-nav" class="clearfix unexpand">
            {{ $articleList->links() }}
            {{--<span class="page-number current">1</span><a class="page-number" href="/page/2/">2</a><a class="page-number" href="/page/3/">3</a><span class="space">&hellip;</span><a class="page-number" href="/page/14/">14</a><a class="extend next" rel="next" href="/page/2/">Next<span></span></a>--}}
        </nav>

    </div>
@endsection

@section('links')
    <div class="linkslist">
        <p class="asidetitle">友情链接</p>
        <ul>

            @foreach($links as $link)
            <li><a href="{{ $link->link_url }}" title="{{ $link->link_name }}">{{ $link->link_name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection