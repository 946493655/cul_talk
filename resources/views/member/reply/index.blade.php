@extends('home.main')
@section('content')
    <div style="height:15px;"></div>
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            <div style="height:15px;"></div>
            <div id="userlist">
                <table>
                    <tr>
                        <td colspan="10" style="text-align:center;"><h3>他人评论</h3></td>
                    </tr>
                    <tr>
                        <td class="return"><a href="{{DOMAIN}}member">←返回</a></td>
                        <td colspan="10">我的话题：
                            <select name="talkid" required onchange="getSel(this.value)">
                                <option value="0" {{$talkid==0?'selected':''}}>所有话题</option>
                                @if(count($talks))
                                    @foreach($talks as $talk)
                                    <option value="{{$talk['id']}}"
                                        {{$talkid==$talk['id']?'selected':''}}>
                                        {{$talk['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        {{--<th>话题名称</th>--}}
                        <th>评论人</th>
                        <th>评论内容</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            {{--<td>{{$data['talkName']}}</td>--}}
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{str_limit($data['intro'],100)}}</td>
                            <td>{{$data['createTime']}}</td>
                            <td>
                                @if($integral&&!$integral['uid2'])
                                <a href="{{DOMAIN}}member/reply/getuser/{{$data['talkid']}}/{{$data['uid']}}">
                                    中意此回答</a>
                                @else /
                                @endif
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

    <script>
        function getSel(talkid){
            if (talkid==0) {
                window.location.href = "{{DOMAIN}}member/reply";
            } else {
                window.location.href = "{{DOMAIN}}member/t/"+talkid+"/reply";
            }
        }
    </script>
@stop