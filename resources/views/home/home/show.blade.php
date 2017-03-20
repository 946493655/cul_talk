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
                                @if(count($cate['child']))
                                    @foreach($cate['child'] as $cate2)
                                        <li><a href="{{DOMAIN}}s/graph/{{$cate2['id']}}/talk"
                                               class="{{$cate_curr==$cate2['id']?'curr':''}}"
                                               title="显示{{$cate2['name']}}的话题">{{$cate2['name']}}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="javascript:;">待添加</a></li>
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
                                <li><a href="{{DOMAIN}}t/{{$topic}}/{{$cate['id']}}/talk"
                                       class="{{$cate_curr==$cate['id']?'curr':''}}"
                                       title="显示{{$cate['name']}}的话题">{{$cate['name']}}</a></li>
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
                                @if(count($cate['child']))
                                    @foreach($cate['child'] as $cate2)
                                        <li><a href="{{DOMAIN}}t/{{$topic}}/{{$cate2['id']}}/talk"
                                               class="{{$cate_curr==$cate2['id']?'curr':''}}"
                                               title="显示{{$cate2['name']}}的话题">{{$cate2['name']}}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="javascript:;">待添加</a></li>
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
                        @if(count($cates))
                            @foreach($cates as $cate)
                                <li><a href="{{DOMAIN}}t/{{$topic}}/{{$cate2['id']}}/talk"
                                       class="{{$cate_curr==$cate2['id']?'curr':''}}"
                                       title="显示{{$cate2['name']}}的话题">{{$cate['name']}}</a></li>
                            @endforeach
                        @else
                            <li>待添加</li>
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
                                <li><a href="{{DOMAIN}}t/{{$topic}}/{{$cate['id']}}/talk"
                                       class="{{$cate_curr==$cate['id']?'curr':''}}"
                                       title="显示{{$cate['name']}}的话题">{{$cate['name']}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @endif
                <div style="height:20px;clear:both;"></div>
            </div>
            {{--话题列表--}}
            <div class="list">
                <p class="crumb">
                    {{$crumbTitles[$topic]}}
                    @if($crumbs&&$parent=$crumbs['parent'])
                        {{is_array($parent)?'> '.$parent['name']:''}}
                        > {{$crumbs['name']}}
                    @else > 所有
                    @endif
                </p>
                <table>
                    <tr><td colspan="10" class="xian"></td></tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                    <tr>
                        <td class="img">
                            @if($data['thumb'])
                            <a href=""><img src="{{$thumb}}" width="100"></a>
                            @else 无
                            @endif
                        </td>
                        <td width="600">
                            <a href="{{DOMAIN}}t/{{$topic}}/talk/{{$data['id']}}">
                                <p class="tname">{{$data['name']}}</p>
                                <p class="intro">{{str_limit($data['intro'],100)}}</p>
                            </a>
                        </td>
                        <td width="100">
                            <p style="font-size:12px;"><a href="javascript:;">
                                    {{$data['read']}} / 0 / 赏{{$data['integral']}}
                                </a></p>
                            <p><a href="{{DOMAIN}}t/{{$topic}}/talk/{{$data['id']}}" title="点击查看详情或回复内容">详情/回复</a></p>
                        </td>
                        <td width="120">
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
    <input type="hidden" name="uid" value="{{Session::has('user')?Session::get('user.uid'):0}}">

    @include('home.home.cate')
@stop