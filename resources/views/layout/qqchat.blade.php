{{--激活QQ客服模板--}}


<style>
    .qqchat { margin:20px;padding:10px 20px;width:120px;color:black;
        position:fixed;right:60px;bottom:150px; }
    .qqchat #bg { width:140px;height:150px;background:#c8c8c8;filter:alpha(opacity=40);-moz-opacity:0.4;opacity:0.4;
        position:absolute;z-index:-1; }
    .qqchat b { padding:0 10px; }
    .qqchat p { margin:0; padding:0; padding-top:5px; }
    .qqchat a { padding:2px 25px;text-decoration:none;color:orangered; }
    .qqchat a:hover { color:red;background:gainsboro; }
    .qqchat .small { margin-top:5px;padding:0 10px;padding-top:5px;width:120px;border-top:1px solid #cccccc;font-size:12px; }
</style>

<div class="qqchat">
    <div id="bg"></div>

    <p><b>有事找我</b></p>
    {{--<p><a href="http://sighttp.qq.com/msgrd?v=3&uin=946493655&site=qq&menu=yes" title="点击QQ咨询" target="_blank">--}}
            {{--<img src="{{PUB}}assets/images/qq_icon.png" width="16"> 九哥--}}
        {{--</a>--}}
    {{--</p>--}}
    <p><a href="http://sighttp.qq.com/msgrd?v=3&uin=2857156840&site=qq&menu=yes" title="点击QQ咨询" target="_blank">
            <img src="{{PUB}}assets/images/qq_icon.png" width="16"> 斯塔克
        </a>
    </p>
    <p><a href="http://sighttp.qq.com/msgrd?v=3&uin=2274138922&site=qq&menu=yes" title="点击QQ咨询" target="_blank">
            <img src="{{PUB}}assets/images/qq_icon.png" width="16"> 土刨子
        </a>
    </p>
    <p class="small">
        {{--Q用户群575078427<br>--}}
        周一 -- 周五：<br>
        09:00-17:00 在线
    </p>
</div>