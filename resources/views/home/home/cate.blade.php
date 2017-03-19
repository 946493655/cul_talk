{{--前台列表页面，添加分类--}}


<style>
    .popup { display:none; }
    .mask { width:100%;height:100%;background:#000000;
        filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5;
        position:fixed;top:0; }
    .popup form { padding:20px;width:800px;color:#808080;background:#ffffff;;
        position:fixed;top:100px;left:20%; }
    .popup form h4 { margin:5px;text-align:center; }
    .popup form input,.popup form textarea,.popup form select {
        margin:5px 0;padding:10px;width:770px;border:1px solid #cccccc;color:#808080; }
    .popup form textarea { height:100px;resize:none; }
    .popup form .close { padding:10px 20px;color:gainsboro;
        background:orangered;text-decoration:none;
        position:absolute;top:0;left:840px; }
    .popup form input[type='submit'] { color:#ffffff;background:#5a5a5a;cursor:pointer; }
    .popup form a:hover.close { color:#ffffff; }
</style>

<div class="popup">
    <div class="mask"></div>
    <form id="formcate" action="" method="POST" data-am-validator>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="uid" value="{{Session::has('user')?Session::get('user.uid'):0}}">
        <h4>添加类别</h4>
        <p>类别名称：
            <input type="text" placeholder="类别名称" minlength="2" maxlength="20" name="name">
        </p>
        <p id="pid"></p>
        <p>类别介绍：
            <textarea name="intro" placeholder=""></textarea>
        </p>
        <h4><input type="submit" value="确定提交" title="确定提交"></h4>
        <a href="javascript:;" title="关闭" class="close" onclick="getClose()"> X </a>
    </form>
</div>

<script>
    function addCate(topic){
        var uid = $("input[name='uid']").val();
        if (uid==0) { alert('没有登录！');return; }
        $("#formcate").attr('action','{{DOMAIN}}s/'+topic+'/cate');
        if (topic==2) {
            var html = "类别选项：";
            html += "<select name='pid' required>";
            html += "<option value='3'>剪辑系列</option>";
            html += "<option value='2'>合成系列</option>";
            html += "<option value='1'>三维系列</option>";
            html += "</select>";
            $("#pid").html(html);
        } else if (topic==4) {
            var html = "类别选项：";
            html += "<select name='pid' required>";
            html += "<option value='9'>程序</option>";
            html += "<option value='8'>前端</option>";
            html += "<option value='7'>UI设计</option>";
            html += "</select>";
            $("#pid").html(html);
        }
        $(".popup").show();
    }
    function getClose(){ $(".popup").hide(); }
</script>