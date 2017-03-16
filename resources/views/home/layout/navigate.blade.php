{{--前台顶部横条菜单--}}


<div id="nav">
    <div id="nav_center">
        {{--<a href="{{DOMAIN}}">首 页</a><a href="">自由话题</a><a href="">图形软件</a><a href="">视频作品</a><a href="">网站设计</a><a href="">人生足迹</a><a href="">更多</a>--}}
        <a href="{{DOMAIN}}" class="{{$_SERVER['REQUEST_URI']=='/'?'curr':''}}">首 页</a>@foreach($navs as $nav)<a href="
            @if($nav['id']==1) {{DOMAIN}}s/free
            @elseif($nav['id']==2) {{DOMAIN}}s/graph
            @elseif($nav['id']==3) {{DOMAIN}}s/video
            @elseif($nav['id']==4) {{DOMAIN}}s/design
            @elseif($nav['id']==5) {{DOMAIN}}s/track
            @endif
                " class="
            @if(isset(explode('/',$_SERVER['REQUEST_URI'])[2]))
                @if($nav['id']==1 && explode('/',$_SERVER['REQUEST_URI'])[2]=='free')curr
                @elseif($nav['id']==2 && explode('/',$_SERVER['REQUEST_URI'])[2]=='graph')curr
                @elseif($nav['id']==3 && explode('/',$_SERVER['REQUEST_URI'])[2]=='video')curr
                @elseif($nav['id']==4 && explode('/',$_SERVER['REQUEST_URI'])[2]=='design')curr
                @elseif($nav['id']==5 && explode('/',$_SERVER['REQUEST_URI'])[2]=='track')curr
                @endif
            @endif
                ">{{$nav['name']}}</a>@endforeach<a href="javascript:;" onclick="addTopic()" @if($_SERVER['REQUEST_URI']=='/topic')class="curr"@endif>更多..</a>
    </div>
</div>

<script>
    function addTopic(){
        window.location.href = '{{DOMAIN}}topic';
    }
</script>