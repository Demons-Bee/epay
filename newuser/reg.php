<?php
$is_defend=true;
include("../includes/common.php");
if(isset($_GET['regok'])){
	exit("<script language='javascript'>alert('恭喜你，商户注册成功！');window.location.href='./login.php';</script>");
}
if($islogin2==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}

if($conf['reg_open']==0)sysmsg('未开放商户申请');

$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['csrf_token'] = $csrf_token;
?>
<!doctype html>
<!-- +qun635032829-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1" name="viewport">
<title>申请商户 | <?php echo $conf['sitename']?></title>
   <meta name="keywords" content="<?php echo $conf['keywords']?>">
<meta name="description" content="<?php echo $conf['description']?>">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="/./AXMBGY3/mbwj/vertical/assets/css/codebase.min-5.0.css" id="css-main" rel="stylesheet">
<link rel="stylesheet" id="css-main" href="/./AXMBGY3/mbwj/vertical/assets/css/codebase.min-5.3.css">
    <link href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-0-M/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
</head>
<body>
    <div class="modal fade" id="modal-top" tabindex="-1" aria-labelledby="modal-top" style="padding-top: 15px; display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document" _mstvisible="1">
      <div class="modal-content">
        <div class="block block-rounded shadow-none mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">注册须知</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="关闭">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
        <?php echo $conf['zhuce']?>      </div>
          <div class="block-content block-content-full block-content-sm text-end border-top">
            <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">我知道了</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="main-content-boxed" id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('/./AXMBGY3/mbwj/vertical/assets/images/photo34@2x.jpg');">
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
                          
                        </div>
                      <form name="form" class="form-validation"><input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>"><input type="hidden" name="verifytype" value="<?php echo $conf['verifytype']?>">
                      <?php if($conf['reg_pay']){?><div class="btn btn-lg btn-alt-primary fw-semibold"style="width: 100%;">商户申请价格为：<b><?php echo $conf['reg_pay_price']?></b>元</div><?php }?>
<div class="list-group list-group-sm swaplogin">
<?php if($conf['verifytype']==1){?>
<br>
 <div class="form-floating mb-4">
                                <input class="form-control no-border" type="text" name="phone" placeholder="手机号码（同时为登录账号）">
                                <label class="form-label" for="username">手机号码（同时为登录账号）</label>
                            </div>
                             <div class="form-floating mb-4">
                                 <div class="input-group">
                                <input class="form-control no-border" type="text" name="code" placeholder="短信验证码">
                           
                                
                                <a class="btn btn-lg btn-alt-primary fw-semibold"  style="width: 50%;" id="sendcode">获取验证码</a>
                            </div>
                            <a id="sendsms">
                             </div>
                             <?php }else{?><br>
                             <div class="form-floating mb-4">
                                <input class="form-control no-border" type="email" name="email" placeholder="邮箱（同时作为登录账号）">
                                <label class="form-label" for="username">邮箱（同时作为登录账号）</label>
                            </div>
                             <div class="form-floating mb-4">
                                 <div class="input-group">
                                <input class="form-control no-border" type="text" name="code" placeholder="邮箱验证码">
                           
                                
                                <a class="btn btn-lg btn-alt-primary fw-semibold"  style="width: 50%;" id="sendcode">获取验证码</a>
                            </div>
                           <a id="sendsms">
                             </div>
                             <?php }?>
                            <div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pwd" placeholder="请输入新密码">
                                <label class="form-label" for="username">输入新密码</label>
                            </div>
 <div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pwd2" placeholder="请输入新密码">
                                <label class="form-label" for="username">再次输入密码</label>
                            </div>
                            <div class="checkbox m-b-md m-t-none">
<label class="i-checks">
  <input type="checkbox" ng-model="agree" checked required><i></i> 同意<a href="../agreement.html" target="_blank">我们的条款</a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="/user/login.php">返回登录</a>
</label>
</div>
                             <div class="mb-4">
                                <button type="button" id="submit" class="btn btn-lg btn-alt-primary fw-semibold" style="width: 100%;" >
                                    创建用户
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
<script src="//cdn.bootcdn.net/ajax/libs/jsrsasign/10.6.1/jsrsasign-all-min.js"></script>>
<script src="/./AXMBGY3/mbwj/loocss/jquery.minBF.js"></script>
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
            $(obj).text("(" + countdown + ") s");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
	var sendto;
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
			url : "ajax.php?act=sendcode",
			data : {sendto:sendto,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
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
		if($("input[name='verifytype']").val()=='1'){
			sendto=$("input[name='phone']").val();
			if(sendto==''){layer.alert('手机号码不能为空！');return false;}
			if(sendto.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			sendto=$("input[name='email']").val();
			if(sendto==''){layer.alert('邮箱不能为空！');return false;}
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(sendto)){layer.alert('邮箱格式不正确！');return false;}
		}
		captchaObj.verify();
	});
};
$(document).ready(function(){
	$("#submit").click(function(){
		if ($(this).attr("data-lock") === "true") return;
		var email=$("input[name='email']").val();
		var phone=$("input[name='phone']").val();
		var code=$("input[name='code']").val();
		var pwd=$("input[name='pwd']").val();
		var pwd2=$("input[name='pwd2']").val();
		if(email=='' || phone=='' || code=='' || pwd=='' || pwd2==''){layer.alert('请确保各项不能为空！');return false;}
		if(pwd!=pwd2){layer.alert('两次输入密码不一致！');return false;}
		if($("input[name='verifytype']").val()=='1'){
			if(phone.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		}
		var ii = layer.load();
		$(this).attr("data-lock", "true");
		var csrf_token=$("input[name='csrf_token']").val();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=reg",
			data : {email:email,phone:phone,code:code,pwd:pwd,csrf_token:csrf_token},
			dataType : 'json',
			success : function(data) {
				$("#submit").attr("data-lock", "false");
				layer.close(ii);
				if(data.code == 1){
					layer.alert('恭喜你，商户申请成功！', {icon: 1}, function(){
						window.location.href="./login.php";
					});
				}else if(data.code == 2){
					var paymsg = '';
					$.each(data.paytype, function(key, value) {
						paymsg+='<button class="btn btn-default btn-block" onclick="window.location.href=\'../submit2.php?typeid='+key+'&trade_no='+data.trade_no+'\'" style="margin-top:10px;"><img width="20" src="../assets/icon/'+value.name+'.ico" class="logo">'+value.showname+'</button>';
					});
					layer.alert('<center><h2>￥ '+data.need+'</h2><hr>'+paymsg+'<hr>提示：支付完成后即可直接登录</center>',{
						btn:[],
						title:'支付确认页面',
						closeBtn: false
					});
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
	<?php if(!empty($conf['zhuce'])){?>
	$('#myModal').modal('show');
	<?php }?>
});
</script>
</body>
</html>