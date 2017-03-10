@extends('home.main')
@section('content')
    {{--<div style="height:10px;"></div>--}}
    <div id="top">
        <img src="{{PUB}}assets/images/icon.png">
        <span id="logoText">交流之地也</span>
        <span id="fabu"><a href="javascript:;">(有奖)发布信息</a></span>
    </div>
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            @if(count($navs))
                @foreach($navs as $nav)
            <div class="box">
                <div class="title">{{$nav['name']}}
                    <a href="" class="more">更多</a>
                </div>
                <div class="solid"></div>
                <div class="nav">
                    <div class="cate"><a href=""><b>
                            @if($nav['id']==1)自定义
                            @elseif($nav['id']==2)视觉设计
                            @elseif($nav['id']==3)视频制作
                            @elseif($nav['id']==4)网站研发
                            @elseif($nav['id']==5)足迹沧桑
                            @endif
                            </b></a></div>
                    @if($nav['id']==1)
                        @foreach($cate1s as $cate)
                        <div class="cate"><a href="">{{$cate['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==2 && count($cate2s))
                        @foreach($cate2s as $cate)
                        <div class="cate"><a href="">{{$cate['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==3 && count($cate3s))
                        @foreach($cate3s as $cate)
                        <div class="cate"><a href="">{{$cate['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==4 && count($cate4s))
                        @foreach($cate4s as $cate)
                        <div class="cate"><a href="">{{$cate['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==5 && count($cate5s))
                        @foreach($cate5s as $cate)
                        <div class="cate"><a href="">{{$cate['name']}}</a></div>
                        @endforeach
                    @endif
                </div>
                <div class="dashed"></div>
                <div class="cont">
                    <div class="talk"><a href=""><b>话题内容</b></a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
@stop