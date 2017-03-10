{{--前台顶部横条菜单--}}


<div id="nav">
    <div id="nav_center">
        {{--<a href="{{DOMAIN}}">首 页</a><a href="">自由话题</a><a href="">图形软件</a><a href="">视频作品</a><a href="">网站设计</a><a href="">人生足迹</a><a href="">更多</a>--}}
        <a href="{{DOMAIN}}" class="{{$_SERVER['REQUEST_URI']=='/'?'curr':''}}">首 页</a>
        @foreach($navs as $nav)
            <a href="{{DOMAIN}}t/{{$nav['id']}}">{{$nav['name']}}</a>
        @endforeach
        <a href="javascript:;">更多..</a>
    </div>
</div>