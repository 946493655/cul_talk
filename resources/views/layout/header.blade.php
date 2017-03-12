{{--顶部头模板--}}

<div id="header">
    <div id="header_center">
        <span class="left">
            @if(!Session::has('user'))
            <a href="{{DOMAIN}}login">用户登陆</a>
            @else
            <a href="javascript:;">会员名：{{Session::get('user.username')}}</a>
            @endif
        </span>
        <span class="right">
            <a href="javascript:;">帮助</a> &nbsp;
            <a href="{{env('WWW_DOMAIN')}}" target="_blank">主网站</a> &nbsp;
            <a href="{{env('ONLINE_DOMAIN')}}" target="_blank">在线创作</a>
        </span>
    </div>
</div>