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
                        <td class="left">
                            <a href="javascript:;" onclick="history.go(-1);" title="点击返回上一页">←返回</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="left" width="250">用户名称：{{$userInfo['username']}}</td>
                        <td class="left">用户类型：{{$userInfo['userType']}}</td>
                        <td class="left" width="300">公司名：
                            {{$userInfo['company']?$userInfo['company']['name']:'未知'}}
                        </td>
                    </tr>
                    <tr>
                        <td class="left">我的专栏：
                            <a href="{{DOMAIN}}member/topic">{{count($topics)}} 查看</a>
                        </td>
                        <td class="left">我的类别：
                            <a href="{{DOMAIN}}member/cate">{{count($cates)}} 查看</a>
                        </td>
                        <td class="left">我的话题：
                            <a href="{{DOMAIN}}member/talk">{{count($talks)}} 查看</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">我的评论：
                            <a href="{{DOMAIN}}member/comment">{{count($comments)}} 查看</a>
                        </td>
                        <td class="left">得到回复：
                            <a href="{{DOMAIN}}member/reply">{{count($comments)}} 查看</a>
                        </td>
                        <td class="left">我的积分：{{$param['integral']}}
                            <a href="{{DOMAIN}}member/award">奖励记录</a>
                            <a href="{{DOMAIN}}member/integral">交易记录</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">得到点赞：
                            <a href="{{DOMAIN}}member/talk/click">{{count($clicks)}} 查看</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop