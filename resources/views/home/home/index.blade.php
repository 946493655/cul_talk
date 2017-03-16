@extends('home.main')
@section('content')
    @include('home.layout.top')
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            @if(count($topics))
                @foreach($topics as $topic)
            <div class="box" style="
                {{--确定浮动垂直间距--}}
                {{--@if($topic['id']==6)top:-20px;@endif--}}
                ">
                <div class="title">{{$topic['name']}}
                    <a href="
                        @if($topic['id']==1) {{DOMAIN}}s/free
                        @elseif($topic['id']==2) {{DOMAIN}}s/graph
                        @elseif($topic['id']==3) {{DOMAIN}}s/video
                        @elseif($topic['id']==4) {{DOMAIN}}s/design
                        @elseif($topic['id']==5) {{DOMAIN}}s/track
                        @elseif($topic['id']>5) {{DOMAIN}}s/{{$topic['id']}}
                        @endif
                        " class="more">更多</a>
                </div>
                <div class="solid"></div>
                {{--以下是分类--}}
                <div class="nav">
                    <div class="cate"><a href="javascript:;"><b>
                                @if($topic['id']<6) {{$crumbTitles[$topic['id']]}}
                                @else {{$topic['name']}}
                                @endif
                            </b></a>
                    </div>
                    @if($cates=CateByTopicid(3,$topic['id']))
                        @foreach($cates as $cate)
                        <div class="cate">
                            <a href="
                            @if($topic['id']==1) {{DOMAIN}}s/free/{{$cate['id']}}/talk
                            @elseif($topic['id']==2) {{DOMAIN}}s/graph/{{$cate['id']}}/talk
                            @elseif($topic['id']==3) {{DOMAIN}}s/video/{{$cate['id']}}/talk
                            @elseif($topic['id']==4) {{DOMAIN}}s/design/{{$cate['id']}}/talk
                            @elseif($topic['id']==5) {{DOMAIN}}s/track/{{$cate['id']}}/talk
                            @else {{DOMAIN}}s/{{$topic['id']}}/{{$cate['id']}}/talk
                            @endif
                                ">{{$cate['name']}}</a></div>
                        @endforeach
                    @endif
                </div>
                <div class="dashed"></div>
                {{--二级类别--}}
                @if($topic['id']==2 && CatesByLevel($topic['id'],2))
                <div class="nav">
                    @foreach(CatesByLevel($topic['id'],2) as $cate)
                    <div class="cate"><a href="{{DOMAIN}}s/graph/{{$cate['id']}}/talk">
                            {{$cate['name']}}</a></div>
                    @endforeach
                    <div class="cate"><a href="">子类测试</a></div>
                </div>
                <div class="dashed"></div>
                @endif
                {{--以下是话题--}}
                <div class="cont" @if($topic['id']==2)style="height:100px;"@endif>
                    @if($talks=TalkByTopicid(3,$topic['id']))
                        @foreach($talks as $talk)
                            <div class="talk"><a href="{{DOMAIN}}t/{{$topic['id']}}/talk/{{$talk['id']}}">
                                    {{$talk['name']}}</a></div>
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