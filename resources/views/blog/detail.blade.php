@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <article id="article" class="uk-article">
            <h1 class="uk-article-title">{{$article['title']}}</h1>
            <a href="javascript:void(0);">{{$article['author']}}</a>
            <time class="uk-article-meta">
                <i class="uk-icon-calendar"></i>{{mb_substr($article['write_time'], 0, 10)}}
            </time>
            <br>
            @foreach($article['contents'] as $content)
                {!! $content['content'] !!}
            @endforeach

            <div class="tags uk-clearfix">
                @if(count($article['tags']) > 0)
                <div class="tags uk-float-left">
                    <i class="uk-icon-tags"></i>
                    @foreach($article['tags'] as $tag)
                        <a href="{{url('tag/' . urlencode($tag['tag']))}}" rel="tag">{{$tag['tag']}}</a>
                    @endforeach
                </div>
                @endif
                <div class="uk-float-right"></div>
            </div>
        </article>
    </div>
@endsection