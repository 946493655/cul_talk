@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            <div style="height:15px;"></div>
            {{--分类面板--}}
            <div class="showcate">
                @if($topic==2)
                    <div class="bigcate">
                        <a href="" title="显示所有有关图形软件的话题">
                            视觉设计</a>
                    </div>
                    @if(count($cates))
                        @foreach($cates as $cate)
                            <ul>
                                <li>{{$cate['name']}}：</li>
                                <li><a href="">123</a></li>
                                <li><a href="">123</a></li>
                                @if(count($cate['child']))
                                    @foreach($cate['child'] as $cate2)
                                        <li><a href="">{{$cate2['name']}}</a></li>
                                        <li><a href="">{{$cate2['name']}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        @endforeach
                    @endif
                @elseif($topic==3)
                    <div class="bigcate">
                        <a href="" title="显示所有有关视频作品的话题">
                            视频作品</a>
                    </div>
                    <ul>
                        @if(count($cates))
                            @foreach($cates as $cate)
                                <li><a href="" title="显示{{$cate['name']}}的话题">
                                        {{$cate['name']}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @elseif($topic==4)
                    <div class="bigcate">
                        <a href="" title="显示所有有关网站制作的话题">
                            网站制作</a>
                    </div>
                    @if(count($cates))
                        @foreach($cates as $cate)
                            <ul>
                                <li>{{$cate['name']}}：</li>
                                <li><a href="">123</a></li>
                                <li><a href="">123</a></li>
                                @if(count($cate['child']))
                                    @foreach($cate['child'] as $cate2)
                                        <li><a href="">{{$cate2['name']}}</a></li>
                                        <li><a href="">{{$cate2['name']}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        @endforeach
                    @endif
                @elseif($topic==1)
                    <div class="bigcate">
                        <a href="" title="显示所有有关自定义的话题">
                            自定义话题</a>
                    </div>
                    <div class="bigcate">
                        <a href="" title="去添加一个分类">添加分类</a>
                    </div>
                    <ul>
                        <li>??</li>
                        @if(count($cates))
                            @foreach($cates as $cate)
                                <li><a href="" title="显示{{$cate['name']}}的话题">
                                        {{$cate['name']}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @elseif($topic==5)
                    <div class="bigcate">
                        <a href="" title="显示所有有关人生足迹的话题">
                            足迹沧桑</a>
                    </div>
                    <div class="bigcate">
                        <a href="" title="去添加一个分类">添加分类</a>
                    </div>
                    <ul>
                        <li>??</li>
                        @if(count($cates))
                            @foreach($cates as $cate)
                                <li><a href="" title="显示{{$cate['name']}}的话题">
                                        {{$cate['name']}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @endif
                <div style="height:20px;clear:both;"></div>
            </div>
            {{--话题列表--}}
            <div class="list">
                <table>
                    <tr><td colspan="10" class="xian"></td></tr>
                    <tr>
                        <td class="img"><img src=""></td>
                        <td class="intro">
                            <p>123</p>
                            <p>123</p>
                        </td>
                        <td>number</td>
                        <td>
                            <p>作者</p>
                            <p>时间</p>
                        </td>
                    </tr>
                </table>
            </div>
            @include('home.layout.page')
        </div>
    </div>
@stop