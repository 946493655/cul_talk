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
                        <td colspan="10" style="text-align:center;"><h3>用户积分奖励列表</h3></td>
                    </tr>
                    <tr>
                        <td class="return">
                            <a href="{{DOMAIN}}member" title="点击返回上一页">←返回</a>
                        </td>
                    </tr>
                    <tr>
                        <th>用户</th>
                        <th>积分</th>
                        <th>创建时间</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{$data['award']}}</td>
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