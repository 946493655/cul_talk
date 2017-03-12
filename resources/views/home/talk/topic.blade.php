@extends('home.main')
@section('content')
    <div style="height:10px;"></div>
    @include('home.layout.navigate')
    <div id="contain" @if(count($topics)<12)style="height:700px;"@endif>
        <div id="contain_center">
            <div style="height:15px;"></div>
            <div style="padding:15px;color:#808080;cursor:pointer;"
                 onclick="history.go(-1);" title="点击返回上一页">返回</div>
            @if(count($topics))
                @foreach($topics as $topic)
            <a href="{{DOMAIN.'t/'.$topic['id'].'/talk/create'}}"
               title="进入{{$topic['name']}}添加">
                <div class="topicflow">{{$topic['name']}}</div>
            </a>
                @endforeach
            @endif
            <a href="javascript:;" title="添加新专栏">
                <div class="topicflow">专栏添加</div>
            </a>
        </div>
    </div>
@stop