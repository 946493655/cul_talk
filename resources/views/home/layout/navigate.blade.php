{{--前台顶部横条菜单--}}


<div id="nav">
    <div id="nav_center">
        {{--<a href="{{DOMAIN}}">首 页</a><a href="">自由话题</a><a href="">图形软件</a><a href="">视频作品</a><a href="">网站设计</a><a href="">人生足迹</a><a href="">更多</a>--}}
        <a href="{{DOMAIN}}" class="{{$_SERVER['REQUEST_URI']=='/'?'curr':''}}">首 页</a>
        @foreach($navs as $nav)
            <a href="
            @if($nav['id']==1) {{DOMAIN}}free
            @elseif($nav['id']==2) {{DOMAIN}}graph
            @elseif($nav['id']==3) {{DOMAIN}}video
            @elseif($nav['id']==4) {{DOMAIN}}design
            @elseif($nav['id']==5) {{DOMAIN}}track
            @elseif($nav['id']>5) {{DOMAIN}}t/{{$nav['id']}}
            @endif
                " class="
            @if($nav['id']==1&&$_SERVER['REQUEST_URI']=='/free')curr
            @elseif($nav['id']==2&&$_SERVER['REQUEST_URI']=='/graph')curr
            @elseif($nav['id']==3&&$_SERVER['REQUEST_URI']=='/video')curr
            @elseif($nav['id']==4&&$_SERVER['REQUEST_URI']=='/design')curr
            @elseif($nav['id']==5&&$_SERVER['REQUEST_URI']=='/track')curr
            @elseif($nav['id']>5&&$_SERVER['REQUEST_URI']=='/t/'.$nav['id'])curr
            @endif
                ">{{$nav['name']}}</a>
        @endforeach
        <a href="javascript:;" onclick="addTopic()">更多..</a>
    </div>
</div>

<script>
    function addTopic(){
    }
</script>