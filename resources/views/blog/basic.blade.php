<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$pageName}} - {{get_option('blog_title')}}</title>
    <meta name="keywords" content="@if(isset($blogKeywords)){{$blogKeywords}},@endif{{get_option('blog_keywords')}}"/>
    <meta name="description" content="{{$blogDescription or get_option('blog_description')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{cdn('css/style.css')}}" rel="stylesheet">
    @yield('head-extend')
</head>
<body>

<div class="container" id="main">
    <div class="row">
        {{--个人--}}
        <div class="col-sm-4 col-md-3 col-lg-2">
            <div id="profile">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <img src="{{get_option('avatar')}}" class="img-circle img-responsive center-block avatar" alt="{{get_option('blog_keywords')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-center h3">{{get_option('blog_title')}}</h1>
                            <p class="text-center">{{get_option('blog_subtitle')}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-2 text-center col-xs-offset-3 btn-stat">
                            <span>{{$stat['articleTotal'] or 0}}</span>
                            <span><i class="glyphicon glyphicon-file" aria-hidden="true"></i></span>
                            <a href="{{url('blog')}}" class="link" data-toggle="tooltip" data-placement="bottom" title="文章"></a>
                        </div>
                        <div class="col-xs-2 text-center btn-stat">
                            <span>{{$stat['columnTotal'] or 0}}</span>
                            <span><i class="glyphicon glyphicon-book" aria-hidden="true"></i></span>
                            <a href="{{url('column')}}" class="link" data-toggle="tooltip" data-placement="bottom" title="栏目"></a>
                        </div>
                        <div class="col-xs-2 text-center btn-stat">
                            <span>{{$stat['tagTotal'] or 0}}</span>
                            <span><i class="glyphicon glyphicon-tag" aria-hidden="true"></i></span>
                            <a href="{{url('tag')}}" class="link" data-toggle="tooltip" data-placement="bottom" title="标签"></a>
                        </div>
                    </div>

                    <div class="list-group" id="nav">
                        @if(isset($navs))
                            @foreach($navs as $nav)
                                @if($nav['active'])
                                    <a href="{{$nav['url']}}" class="list-group-item active" title="{{$nav['column_name']}}">{{$nav['column_name']}}</a>
                                @else
                                    <a href="{{$nav['url']}}" class="list-group-item" title="{{$nav['column_name']}}">{{$nav['column_name']}}</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="row copyright hidden-xs">
                    <div class="col-xs-12">
                        <p class="text-center">&copy; lenbo {{date('Y')}}</p>
                        <p class="text-center">{{get_option('icp_number')}}</p>
                    </div>
                </div>
            </div>
        </div>

        {{--主体--}}
        <div class="col-sm-8 col-md-7 col-lg-8">
            @yield('container')

            <div class="row copyright visible-xs-block">
                <div class="col-xs-12">
                    <p class="text-center">&copy; lenbo {{date('Y')}} | {{get_option('icp_number')}}</p>
                </div>
            </div>
        </div>

        {{--右侧广告--}}
        <div class="col-md-2 hidden-sm hidden-xs">
            {{--右侧广告--}}
        </div>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?d0754ebee2c0ba0c2983368f42b0462c";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();

    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        } else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</body>
</html>