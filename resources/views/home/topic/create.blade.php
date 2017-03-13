@extends('home.main')
@section('content')
    <div style="height:15px;"></div>
    @include('home.layout.navigate')
    <div id="contain">
        <div id="contain_center">
            <div style="height:15px;"></div>
            <form action="{{DOMAIN}}topic" method="POST" data-am-validator>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p id="return" onclick="history.go(-1);" title="点击返回上一页">返回</p>
                <p>专栏名称：
                    <input type="text" placeholder="" minlength="2" maxlength="20" required name="name">
                </p>
                <p>专栏介绍：
                    <textarea placeholder="" minlength="2" maxlength="255" required name="intro"></textarea>
                </p>
                <p style="text-align:center">
                    <input type="submit" id="submit" title="点击确定提交" value="确定提交">
                </p>
            </form>
        </div>
    </div>
@stop