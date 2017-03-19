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
                        <td colspan="10" style="text-align:center;"><h3>用户话题列表</h3></td>
                    </tr>
                    <tr>
                        <td width="50"><a href="{{DOMAIN}}member">←返回</a></td>
                    </tr>
                    <tr>
                        <th>用户</th>
                        <th>话题名称</th>
                        <th>赏积分</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{UserNameById($data['uid'])}}</td>
                            <td>{{$data['name']}}</td>
                            <td>{{$data['integral']}}</td>
                            <td>{{$data['createTime']}}</td>
                            <td>
                                @if(!$data['integral'])
                                <a href="javascript:;" title="设置要赏赐给回复者的积分数量"
                                onclick="addIntegral({{$data['id']}})">赏积分</a>
                                @else /
                                @endif
                                <input type="hidden" name="name_{{$data['id']}}" value="{{$data['name']}}">
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

    <div class="popup">
        <div class="mask"></div>
        <form id="formpopup" action="{{DOMAIN}}account/integral" method="POST" data-am-validator>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="talkid">
            <h4>设置 <span id="tname">该话题</span> 要赏的积分数量</h4>
            <p>您还有积分数量：{{$param?$param['integral']:0}}</p>
            <p>准备付出的积分数量：
                <input type="text" placeholder="积分数量" required pattern="^\d+$" name="number">
            </p>
            <h4><input type="submit" value="确定提交" title="确定提交"></h4>
            <a href="javascript:;" title="关闭" class="close" onclick="getClose()"> X </a>
        </form>
    </div>

    <script>
        function addIntegral(talkid){
            var talkName = $("input[name='name_"+talkid+"']").val();
            $("input[name='talkid']")[0].value = talkid;
            $("#tname").html(talkName);
            $(".popup").show();
        }
        function getClose(){ $(".popup").hide(); }
    </script>
@stop