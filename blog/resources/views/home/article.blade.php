@extends('layouts.home')

@section('content')
    <div id="main" class="post" itemscope itemprop="blogPost">

        <article itemprop="articleBody">
            <header class="article-info clearfix">
                <h1 itemprop="name">
                    <a href="{{ url('article', $currentArticle->art_id) }}" title="{{ $currentArticle->art_title }}" itemprop="url">{{ $currentArticle->art_title }}</a>
                </h1>

                <p class="article-time">
                    <time datetime="" itemprop="datePublished"> 发表于 {{ date('Y-m-d H:i', $currentArticle->art_time) }}</time>
                </p>
            </header>

            <div class="article-content">

                <div id="toc" class="toc-article">
                    <strong class="toc-title">文章目录</strong>
                    <ol class="toc">
                        <li class="toc-item toc-level-2"><a class="toc-link" href="#u7B80_u4ECB"><span class="toc-number">1.</span> <span class="toc-text">简介</span></a></li>
                        <li class="toc-item toc-level-2"><a class="toc-link" href="#u4F7F_u7528_u65B9_u6CD5"><span class="toc-number">2.</span> <span class="toc-text">使用方法</span></a></li>
                        <li class="toc-item toc-level-2"><a class="toc-link" href="#u4E00_u4E9B_u6280_u5DE7_u548C_u5FC3_u5F97"><span class="toc-number">3.</span> <span class="toc-text">一些技巧和心得</span></a></li>
                        <li class="toc-item toc-level-2"><a class="toc-link" href="#u63A8_u8350_u8BFB_u7269"><span class="toc-number">4.</span> <span class="toc-text">推荐读物</span></a></li>
                    </ol>
                </div>

                {!! $currentArticle->art_newstext !!}

            </div>
            <footer class="article-footer clearfix">
                <div class="article-catetags">

                    <div class="article-categories">
                        <span></span>
                        <a class="article-category-link" href="/categories/summary/">summary</a>
                    </div>
                </div>

                <div class="article-share" id="share">
                    <div data-url="http://blog.devtang.com/2016/04/12/tomato-time-management/" data-title="「番茄工作法」- 简单的时间管理方法 | 唐巧的技术博客" data-tsina="undefined" class="share clearfix">
                    </div>
                </div>

            </footer>
        </article>

        <nav class="article-nav clearfix">

            <div class="prev" >
                <a href="{{ is_null($currentArticle['pre']) ? "#" : url('article', $currentArticle['pre']->art_id) }}" title="{{ is_null($currentArticle['pre']) ? "没有上一篇了" : $currentArticle['pre']->art_title }}">
                    <strong>上一篇：</strong><br/>
                    <span>{{ is_null($currentArticle['pre']) ? "没有上一篇了" : $currentArticle['pre']->art_title }}</span>
                </a>
            </div>

            <div class="next">
                <a href="{{ is_null($currentArticle['next']) ? "#" : url('article', $currentArticle['next']->art_id) }}"  title="{{ is_null($currentArticle['next']) ? "没有下一篇了" : $currentArticle['next']->art_title }}">
                    <strong>下一篇：</strong><br/>
                    <span>{{ is_null($currentArticle['next']) ? "没有下一篇了" : $currentArticle['next']->art_title }}</span>
                </a>
            </div>

        </nav>


        <section id="comments" class="comment">

        </section>

    </div>
@endsection
