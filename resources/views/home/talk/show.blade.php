@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center" style="width:1000px">
            <div style="height:15px;"></div>
            <div id="homeshow">
                <div class="time">
                    <a href="javascript:;" onclick="history.go(-1);">→返回</a>
                    <span class="small"> &nbsp;&nbsp;&nbsp;
                        {{$data['createTime']}}
                    </span>
                </div>
                <div class="title">{{$data['name']}}</div>
                <div class="img"><img src="{{$data['thumb']}}"></div>
                <div class="con">{{$data['intro']}}</div>
            </div>
            {{--话题列表--}}
            <div class="list">
                <p class="crumb">该话题的回复：</p>
                <table>
                    <tr><td colspan="10" class="xian"></td></tr>
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
                    @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                    @endif
                </table>
                @include('home.layout.page')
            </div>
        </div>
    </div>
@stop