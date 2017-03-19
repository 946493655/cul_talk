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
                        <td colspan="10" style="text-align:center;"><h3>用户评论列表</h3></td>
                    </tr>
                    <tr>
                        <td class="return"><a href="{{DOMAIN}}member">←返回</a></td>
                    </tr>
                    <tr>
                        <th>用户</th>
                        <th>评论内容</th>
                        <th>创建时间</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{str_limit($data['intro'],100)}}</td>
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