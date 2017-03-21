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
                        <td colspan="10" style="text-align:left;"><a href="{{DOMAIN}}member">←返回</a></td>
                    </tr>
                    <tr>
                        <th>话题名称</th>
                        <th width="300">内容</th>
                        <th>缩略图</th>
                        <th>赏积分</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data['name']}}</td>
                            <td>{{str_limit($data['intro'],100)}}</td>
                            <td>@if($data['thumb']) <img src="{{$data['thumb']}}" width="30">
                                @else /
                                @endif
                            </td>
                            <td>{{$data['integral']}}</td>
                            <td>{{$data['createTime']}}</td>
                            <td>
                                <a href="{{DOMAIN}}member/talk/{{$data['id']}}">详情</a>
                                @if(!$data['integral'])
                                <a href="javascript:;" title="设置要赏赐给回复者的积分数量"
                                    onclick="addIntegral({{$data['id']}})">赏积分</a>
                                @endif
                                <a href="javascript:;" title="设置缩略图"
                                    onclick="getUpload({{$data['id']}})">缩略图</a>
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

    <div class="popup" id="integral">
        <div class="mask"></div>
        <form id="formpopup" action="{{DOMAIN}}member/integral" method="POST" data-am-validator>
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
    <div class="popup" id="thumb">
        <div class="mask"></div>
        <form id="formthumb" action="" method="POST" data-am-validator enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h4>设置缩略图</h4>
            <input type="file" name="url_ori" style="cursor:pointer;"/>
            <h4><input type="submit" value="确定上传" title="确定上传"></h4>
            <a href="javascript:;" title="关闭" class="close" onclick="getClose()"> X </a>
        </form>
    </div>

    <script>
        function addIntegral(talkid){
            var talkName = $("input[name='name_"+talkid+"']").val();
            $("input[name='talkid']")[0].value = talkid;
            $("#tname").html(talkName);
            $("#integral").show();
        }
        function getUpload(talkid){
            $("#formthumb").attr("action","{{DOMAIN}}member/talk/thumb/"+talkid);
            $("#thumb").show();
        }
        function getClose(){ $(".popup").hide(); }
    </script>
@stop