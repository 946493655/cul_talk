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
                        <td><a href="javascript:;" onclick="history.go(-1);" title="点击返回上一页">←返回</a></td>
                    </tr>
                    <tr>
                        <td>用户</td>
                        <td>积分</td>
                        <td>创建时间</td>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{$data['award']}}</td>
                            <td>{{$data['createTime']}}</td>
                        </tr>
                        @endforeach
                    @endif
                </table>
                @include('home.layout.page')
            </div>
        </div>
    </div>
@stop