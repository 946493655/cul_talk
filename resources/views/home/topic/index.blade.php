@extends('home.main')
@section('content')
    <div style="height:10px;"></div>
    @include('home.layout.navigate')
    <div id="contain" @if(count($datas)<9)style="height:800px;"@endif>
        <div id="contain_center">
            <div style="height:15px;"></div>
            <div style="padding:15px;color:#808080;cursor:pointer;"
                 onclick="history.go(-1);" title="点击返回上一页">返回</div>
            @if(count($datas))
                @foreach($datas as $data)
            <a href="javascript:;">
                <div class="topicflow">
                    {{$data['name']}}
                    <div class="small">版主：{{UserNameById($data['uid'])?UserNameById($data['uid']):'本站'}}</div>
                    <div class="small" style="height:40px;">{{str_limit($data['intro'],100)}}</div>
                </div>
            </a>
                @endforeach
            @endif
            <a href="{{DOMAIN}}topic/create" title="添加新专栏">
                <div class="topicflow" style="padding:70px 0;">
                    专栏添加
                    <div class="small">去添加</div>
                </div>
            </a>
        </div>
    </div>
@stop