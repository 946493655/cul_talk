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
                <p style="text-align:center;">
                    <a href="javascript:;" onclick="getPraise({{$data['id']}})">
                        <img src="{{PUB}}assets/images/dianzan.png" width="20"> 点赞
                        <span id="dianzan">{{count($data['clickNum'])}}</span>
                    </a>
                </p>
            </div>
            {{--回复列表--}}
            <div class="list">
                <p class="crumb">该话题的回复：</p>
                <div class="xian"></div>
                <table>
                    <tr><td colspan="10" id="huifu">
                            <textarea placeholder="评论" name="reply"></textarea>
                            <input type="hidden" name="topic_id" value="{{$topic_id}}">
                            <input type="hidden" name="talkid" value="{{$data['id']}}">
                            <a href="javascript:;" title="确定提交评论" onclick="addReply()">提交</a>
                        </td></tr>
                    @if(count($comments))
                        @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment['intro']}}</td>
                        <td width="100">
                            <p>{{UserNameById($comment['uid'])}}</p>
                            <p style="font-size:12px;">{{$comment['createTime']}}</p>
                        </td>
                    </tr>
                        @endforeach
                    @else <tr><td colspan="10" style="text-align:center;color:#808080;">没有记录</td></tr>
                    @endif
                </table>
                @include('home.layout.page')
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="uid" value="{{Session::has('user')?Session::get('user.uid'):0}}">

    <script>
        function addReply(){
            var topic_id = $("input[name='topic_id']").val();
            var talkid = $("input[name='talkid']").val();
            var reply = $("textarea[name='reply']").val();
            if (talkid==0 && talkid==null) { alert("参数错误！");return; }
            if (reply=='') { alert("回复内容未填！");return; }
            window.location.href = '{{DOMAIN}}member/reply/add?topic_id='+topic_id+'&talkid='+talkid+'&reply='+reply;
        }
        function getPraise(talkid){
            var uid = $("input[name='uid']").val();
            var praise = $("#dianzan").html() * 1;
            if (uid==0) { alert("未登录！");return; }
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            $.ajax({
                type: 'POST',
                url: '{{DOMAIN}}member/talk/praise',
                data: {'id':talkid,'uid':uid},
                dataType: 'json',
                success: function(data) {
                    if (data.code!=0) {
                        alert(data.msg);return;
                    }
                    $("#dianzan").html(praise+1);
                }
            });
        }
    </script>
@stop