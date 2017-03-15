@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center" style="width:1000px">
            <div style="height:15px;"></div>
            {{--分类面板--}}
            <div class="showcate">
                @if($topic==2)
                    <div class="bigcate">
                        <a href="{{DOMAIN}}s/graph" title="显示所有有关图形软件的话题">
                            {{$crumbTitles[$topic]}}</a>
                    </div>
                    <div class="bigcate">
                        <a href="javascript:;" title="去添加一个分类" onclick="addCate(2)">
                            添加分类</a>
                    </div>
                    @if(count($cates))
                        @foreach($cates as $cate)
                            <ul>
                                <li>{{$cate['name']}}：</li>
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
                        <a href="{{DOMAIN}}s/video" title="显示所有有关视频作品的话题">
                            {{$crumbTitles[$topic]}}</a>
                    </div>
                    <div class="bigcate">
                        <a href="javascript:;" title="去添加一个分类" onclick="addCate(3)">
                            添加分类</a>
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
                        <a href="{{DOMAIN}}s/design" title="显示所有有关网站制作的话题">
                            {{$crumbTitles[$topic]}}</a>
                    </div>
                    <div class="bigcate">
                        <a href="javascript:;" title="去添加一个分类" onclick="addCate(4)">
                            添加分类</a>
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
                        <a href="{{DOMAIN}}s/free" title="显示所有有关自定义的话题">
                            {{$crumbTitles[$topic]}}</a>
                    </div>
                    <div class="bigcate">
                        <a href="javascript:;" title="去添加一个分类" onclick="addCate(1)">
                            添加分类</a>
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
                        <a href="{{DOMAIN}}s/track" title="显示所有有关人生足迹的话题">{{$crumbTitles[$topic]}}</a>
                    </div>
                    <div class="bigcate">
                        <a href="javascript:;" title="去添加一个分类" onclick="addCate(5)">
                            添加分类</a>
                    </div>
                    <ul>
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
                <p class="crumb">
                    {{$crumbTitles[$topic]}} > {{$crumbs?$crumbs['name']:'所有'}}
                    @if($crumbs&&$parent=$crumbs['parent'])> {{$parent['name']}}@endif
                </p>
                <table>
                    <tr><td colspan="10" class="xian"></td></tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                    <tr>
                        <td class="img"><a href=""><img src=""></a></td>
                        <td width="600"><a href="">
                            <p class="tname">{{$data['name']}}</p>
                            <p>{{str_limit($data['intro'],100)}}</p>
                            </a></td>
                        <td width="50">
                            <p><a href="javascript:;">{{$data['read']}} / 0</a></p>
                            <p>
                                <a href="javascript:;">回复</a>
                            </p>
                        </td>
                        <td width="100">
                            <p>{{UserNameById($data['uid'])}}</p>
                            <p style="font-size:12px;">{{$data['createTime']}}</p>
                        </td>
                    </tr>
                        @endforeach
                    @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                    @endif
                </table>
            </div>
            @include('home.layout.page')
        </div>
    </div>

    @include('home.home.cate')
@stop