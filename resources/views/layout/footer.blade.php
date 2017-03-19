{{--底部脚模板--}}


<div style="height:40px;"></div>
<div id="foot">
    <div id="footer">
        <a href="{{DOMAIN}}">首页</a>
        <a href="{{env('WWW_DOMAIN')}}">主网址</a>
        <a href="{{env('ONLINE_DOMAIN')}}">创作中心</a>
    </div>
</div>

@include('layout.qqchat')