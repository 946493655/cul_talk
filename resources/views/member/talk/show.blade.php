@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            <div style="height:15px;"></div>
            <div id="homeshow">
                <div class="time">
                    <a href="javascript:;" onclick="history.go(-1);">→返回</a>
                    <span class="small"> &nbsp;&nbsp;&nbsp;
                        {{$data['createTime']}}
                    </span>
                </div>
                <div class="title">{{$data['name']}}</div>
                @if($data['thumb'])
                <div class="img"><img src="{{$data['thumb']}}" border="0"></div>
                @endif
                <div class="con">{{$data['intro']}}</div>
            </div>
        </div>
    </div>

    <script>
        function addReply(){
            var topic_id = $("input[name='topic_id']").val();
            var talkid = $("input[name='talkid']").val();
            var reply = $("textarea[name='reply']").val();
            if (talkid==0 && talkid==null) { alert("参数错误！");return; }
            if (reply=='') { alert("回复内容未填！");return; }
            window.location.href = '{{DOMAIN}}member/reply/add?topic_id='+topic_id+'&talkid='+talkid+'&reply='+reply;
        }
    </script>
@stop