@extends('home.main')
@section('content')
    <div style="height:10px;"></div>
    @include('home.layout.navigate')

    <div id="contain">
        <div id="contain_center">
            <div class="box">
                <div class="title">自由话题
                    <a href="" class="more">更多</a>
                </div>
                <div class="solid"></div>
                <div class="nav">
                    <div class="cate"><a href=""><b>分类</b></a></div>
                    <div class="cate"><a href="">分类</a></div>
                    <div class="cate"><a href="">分类</a></div>
                    <div class="cate"><a href="">分类</a></div>
                </div>
                <div class="dashed"></div>
                <div class="cont">
                    <div class="talk"><a href=""><b>话题内容</b></a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                    <div class="talk"><a href="">话题内容</a></div>
                </div>
            </div>
        </div>
    </div>
@stop