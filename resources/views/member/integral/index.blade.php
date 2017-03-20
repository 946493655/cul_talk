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
                        <td colspan="10" style="text-align:center;"><h3>用户积分奖励类别</h3></td>
                    </tr>
                    <tr>
                        <td class="return"><a href="{{DOMAIN}}member">←返回</a></td>
                        <td colspan="10">
                            <a href="{{DOMAIN}}member/integral" class="{{$genre==1?'curr':''}}">积分支出</a> &nbsp;&nbsp;
                            <a href="{{DOMAIN}}member/integral/s/2" class="{{$genre==2?'curr':''}}">积分收入</a>
                        </td>
                    </tr>
                    <tr>
                        <th>话题名称</th>
                        <th>话题主人</th>
                        <th>回复人</th>
                        <th>积分</th>
                        <th>创建时间</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data['talkName']}}</td>
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{UserNameById($data['uid2'])}}</td>
                            <td>{{$data['number']}}</td>
                            <td>{{$data['createTime']}}</td>
                        </tr>
                        @endforeach
                    @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                    @endif
                </table>
                @include('home.layout.page')
            </div>
        </div>
    </div>
@stop