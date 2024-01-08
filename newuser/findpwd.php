<?php

include("../includes/common.php");

//if($conf['reg_open']==0)sysmsg('未开放商户申请');

$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['csrf_token'] = $csrf_token;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1" name="viewport">
   <title>找回密码 | <?php echo $conf['sitename']?></title>
   <meta name="keywords" content="<?php echo $conf['keywords']?>">
<meta name="description" content="<?php echo $conf['description']?>">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="./AXMBGY3/mbwj/vertical/assets/css/codebase.min-5.0.css" id="css-main" rel="stylesheet">
<link rel="stylesheet" id="css-main" href="./AXMBGY3/mbwj/vertical/assets/css/codebase.min-5.3.css">
    <link href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-0-M/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
</head>
<body>
<div class="main-content-boxed" id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('./AXMBGY3/mbwj/vertical/assets/images/photo34@2x.jpg');">
            <div class="row mx-0 bg-black-50">
                <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                    <div class="p-4">
                        <p class="fs-3 fw-semibold text-white">
                            Get Inspired and Create.
                        </p>
                        <p class="text-white-75 fw-medium">
                            Copyright &copy; <span data-toggle="year-copy"></span>
                        </p>
                    </div>
                </div>
                <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-body-extra-light">
                    <div class="content content-full">
                        <div class="px-4 py-2 mb-4">
                            <a class="link-fx fw-bold" href="/">
                               <img width="20px";height="20px"; src="/favicon.ico">
                                <span class="fs-4 text-body-color"><?php echo $conf['sitename']?></span>
                            </a>
                            <h5 class="h3 fw-bold mt-4 mb-2">找回密码！</h5>
                        </div>
                       <form name="form" class="form-validation">
<input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>">
<!--<div class="list-group-item">-->
<ul class="nav nav-tabs">
    <select style="width: 100%;"  name="type" class="btn btn-lg btn-alt-primary fw-semibold"><option value="email">使用邮箱找回</option><option value="phone">使用手机找回</option>
</select>
</ul><br>
 <div class="form-floating mb-4">
                                <input class="form-control" type="text" name="account" placeholder="邮箱/手机号">
                                <label class="form-label" for="username">邮箱/手机号</label>
                            </div>
                             <div class="form-floating mb-4">
                                 <div class="input-group">
                                <input class="form-control" type="text" name="code" placeholder="输入验证码">
                           
                                <a class="btn btn-lg btn-alt-primary fw-semibold"  style="width: 50%;" id="sendcode">获取验证码</a>
                            </div>
                             </div>
                            <div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pwd" placeholder="请输入新密码">
                                <label class="form-label" for="username">输入新密码</label>
                            </div>
 <div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pwd2" placeholder="请输入新密码">
                                <label class="form-label" for="username">再次输入密码</label>
                            </div>
                             <div class="mb-4">
                                <button type="button" class="btn btn-lg btn-alt-primary fw-semibold"style="width: 100%;" id="submit">
                                    登录
                                </button>
</form>
                                </div>
                                <div class="text-center">
<p>
<small class="text-muted"><a href="/"><?php echo $conf['sitename']?>|<a href="/"><?php echo $conf['sitename']?><br>&copy; 2016~<?php echo date("Y")?></small>
</p>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="//cdn.bootcdn.net/ajax/libs/jsrsasign/10.6.1/jsrsasign-all-min.js"></script>
<script src="./AXMBGY3/mbwj/loocss/jquery.minBF.js"></script>
<script src="//lib.baomitu.com/layer/3.1.1/layer.min.js"></script>
<script src="//cdn.bootcdn.net/ajax/libs/layer/3.1.1/layer.min.js"></script>
<script src="//lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/layer/3.1.1/layer.min.js"></script>
<script src="//cdn.staticfile.org/layer/3.1.1/layer.min.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
			$(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
	var sendto,type;
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=sendcode2",
			data : {type:type,sendto:sendto,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendsms");
					layer.msg('发送成功，请注意查收！');
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	});
	$('#sendcode').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		type = $("select[name='type']").val();
		sendto=$("input[name='account']").val();
		if(type=='phone'){
			if(sendto==''){layer.alert('手机号码不能为空！');return false;}
			if(sendto.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			if(sendto==''){layer.alert('邮箱不能为空！');return false;}
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(sendto)){layer.alert('邮箱格式不正确！');return false;}
		}
		captchaObj.verify();
	});
};
$(document).ready(function(){
	$("select[name='type']").change(function(){
		if($(this).val() == 'email'){
			$("input[name='account']").attr('placeholder','邮箱');
		}else{
			$("input[name='account']").attr('placeholder','手机号码');
		}
	});
	$("select[name='type']").change();
	$("#submit").click(function(){
		if ($(this).attr("data-lock") === "true") return;
		var type=$("select[name='type']").val();
		var account=$("input[name='account']").val();
		var code=$("input[name='code']").val();
		var pwd=$("input[name='pwd']").val();
		var pwd2=$("input[name='pwd2']").val();
		if(account=='' || code=='' || pwd=='' || pwd2==''){layer.alert('请确保各项不能为空！');return false;}
		if(pwd!=pwd2){layer.alert('两次输入密码不一致！');return false;}
		if(type=='phone'){
			if(account.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(account)){layer.alert('邮箱格式不正确！');return false;}
		}
		var csrf_token=$("input[name='csrf_token']").val();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$(this).attr("data-lock", "true");
		$.ajax({
			type : "POST",
			url : "ajax.php?act=findpwd",
			data : {type:type,account:account,code:code,pwd:pwd,csrf_token:csrf_token},
			dataType : 'json',
			success : function(data) {
				$("#submit").attr("data-lock", "false");
				layer.close(ii);
				if(data.code == 1){
					layer.alert(data.msg, {icon: 1}, function(){window.location.href="login.php"});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$.ajax({
		// 获取id，challenge，success（是否启用failback）
		url: "ajax.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
		type: "get",
		dataType: "json",
		success: function (data) {
			console.log(data);
			// 使用initGeetest接口
			// 参数1：配置参数
			// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
			initGeetest({
				width: '100%',
				gt: data.gt,
				challenge: data.challenge,
				new_captcha: data.new_captcha,
				product: "bind", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
				offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
				// 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
			}, handlerEmbed);
		}
	});
});
</script>
</body>
</html>