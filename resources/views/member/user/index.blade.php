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
                        <td colspan="10" style="text-align:center;"><h3>用户信息</h3></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:;" onclick="history.go(-1);" title="点击返回上一页">返回</a></td>
                    </tr>
                    <tr>
                        <td>用户名称：{{$users['username']}}</td>
                        <td>用户类型：</td>
                        <td>公司名：</td>
                    </tr>
                    <tr>
                        <td>我的专栏：0</td>
                        <td>我的类别：0</td>
                        <td>我的话题：0</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop