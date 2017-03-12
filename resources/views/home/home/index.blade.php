@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            @if(count($navs))
                @foreach($navs as $nav)
            <div class="box">
                <div class="title">{{$nav['name']}}
                    <a href="{{DOMAIN}}t/{{$nav['id']}}" class="more">更多</a>
                </div>
                <div class="solid"></div>
                {{--以下是分类--}}
                <div class="nav">
                    <div class="cate"><a href="javascript:;"><b>
                            @if($nav['id']==1)自定义
                            @elseif($nav['id']==2)视觉设计
                            @elseif($nav['id']==3)视频制作
                            @elseif($nav['id']==4)网站研发
                            @elseif($nav['id']==5)足迹沧桑
                            @endif
                            </b></a>
                    </div>
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
                {{--以下是话题--}}
                <div class="cont">
                    {{--<div class="talk"><a href=""><b>话题内容</b></a></div>--}}
                    @if($nav['id']==1)
                        @foreach($talk1s as $talk1)
                    <div class="talk"><a href="">{{$talk1['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==2)
                        @foreach($talk2s as $talk2)
                        <div class="talk"><a href="">{{$talk2['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==3)
                        @foreach($talk3s as $talk3)
                        <div class="talk"><a href="">{{$talk3['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==4)
                        @foreach($talk4s as $talk4)
                        <div class="talk"><a href="">{{$talk4['name']}}</a></div>
                        @endforeach
                    @elseif($nav['id']==5)
                        @foreach($talk5s as $talk5)
                        <div class="talk"><a href="">{{$talk5['name']}}</a></div>
                        @endforeach
                    @endif
                    <div class="talk"><a href="">话题测试</a></div>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
@stop