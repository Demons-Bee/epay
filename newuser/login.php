<?php
/**
 * 登录
**/
$is_defend=true;
include("../includes/common.php");

if(isset($_GET['logout'])){
	if(!checkRefererHost())exit();
	setcookie("user_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['csrf_token'] = $csrf_token;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1" name="viewport">
    <title>登录 | <?php echo $conf['sitename']?></title>
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
                    
                        </div>
                       <form name="form" class="form-validation" method="post" action="login.php">
                           <input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>">
                           <?php if(!$conf['close_keylogin']){?>
<ul class="nav nav-tabs">
    <li style="width: 48%;" align="center" class="<?php echo $_GET['m']!='key'?'active':null;?>btn btn-lg btn-alt-primary fw-semibold">
  <a href="./login.php">账号登录</a>
</li>&nbsp;&nbsp;
    <li style="width: 48%;" align="center" class="<?php echo $_GET['m']=='key'?'active':null;?>btn btn-lg btn-alt-primary fw-semibold">
  <a href="./login.php?m=key">密钥登录</a>
</li>
</ul><br><?php }?>
<?php if($_GET['m']=='key'){?>
<input type="hidden" name="type" value="0"/>
<!--<div class="list-group-item">-->
 <div class="form-floating mb-4">
                                <input class="form-control" type="text" name="user" placeholder="商户ID"onkeydown="if(event.keyCode==13){$('#submit').click()}">
                                <label class="form-label" for="username">商户ID</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pass" placeholder="商户密钥"onkeydown="if(event.keyCode==13){$('#submit').click()}">
                                <label class="form-label" for="username">商户密钥</label>
                            </div>

<?php }else{?>
<input type="hidden" name="type" value="1"/>
                    <div class="form-floating mb-4">
                                <input class="form-control" type="text" name="user" placeholder="邮箱/手机号"onkeydown="if(event.keyCode==13){$('#submit').click()}">
                                <label class="form-label" for="username">邮箱/手机号</label>
                            </div>
<div class="form-floating mb-4">
                                <input class="form-control" type="password" name="pass" placeholder="密码"onkeydown="if(event.keyCode==13){$('#submit').click()}">
                                <label class="form-label" for="username">密码</label>
                            </div>

                            <?php }?>
 <?php if($conf['captcha_open_login']==1){?>
                            <div class="form-control" id="captcha" style="margin: auto;">
                                <div id="captcha_text">
                                正在加载验证码
	                            </div>
	                       </div>
	                        <div id="captchaform"></div>
	                        <?php }?>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input checked="" class="form-check-input" id="login-remember-me" name="login-remember-me"
                                           type="checkbox" value="">
                                    <label class="form-check-label" for="login-remember-me">记住我</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="reg.php">
                                        创建账户
                                    </a>
                                    <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="findpwd.php">
                                        忘记密码?
                                    </a>
                                </div>
                                
                            </div>
                            <div class="mb-4">
                                <button type="button" class="btn btn-lg btn-alt-primary fw-semibold"style="width: 100%;"  id="submit">
                                    登录
                                </button>
                                <div class="mt-4">
                                   <?php if(!isset($_GET['connect'])){?>
<div class="wrapper text-center">
<?php if($conf['login_alipay']>0 || $conf['login_alipay']==-1){?>
<button type="button" class="btn btn-rounded btn-lg btn-icon btn-default" title="支付宝快捷登录" onclick="window.location.href='oauth.php'"><img src="../assets/icon/alipay.ico" style="border-radius:50px;"></button>
<?php }?>
<?php if($conf['login_qq']>0){?>
<button type="button" class="btn btn-rounded btn-lg btn-icon btn-default" title="QQ快捷登录" onclick="window.location.href='connect.php'"><svg t="1685014769821" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4293" width="32" height="32"><path d="M511.09761 957.257c-80.159 0-153.737-25.019-201.11-62.386-24.057 6.702-54.831 17.489-74.252 30.864-16.617 11.439-14.546 23.106-11.55 27.816 13.15 20.689 225.583 13.211 286.912 6.767v-3.061z" fill="#FAAD08" p-id="4294"></path><path d="M496.65061 957.257c80.157 0 153.737-25.019 201.11-62.386 24.057 6.702 54.83 17.489 74.253 30.864 16.616 11.439 14.543 23.106 11.55 27.816-13.15 20.689-225.584 13.211-286.914 6.767v-3.061z" fill="#FAAD08" p-id="4295"></path><path d="M497.12861 474.524c131.934-0.876 237.669-25.783 273.497-35.34 8.541-2.28 13.11-6.364 13.11-6.364 0.03-1.172 0.542-20.952 0.542-31.155C784.27761 229.833 701.12561 57.173 496.64061 57.162 292.15661 57.173 209.00061 229.832 209.00061 401.665c0 10.203 0.516 29.983 0.547 31.155 0 0 3.717 3.821 10.529 5.67 33.078 8.98 140.803 35.139 276.08 36.034h0.972z" fill="#000000" p-id="4296"></path><path d="M860.28261 619.782c-8.12-26.086-19.204-56.506-30.427-85.72 0 0-6.456-0.795-9.718 0.148-100.71 29.205-222.773 47.818-315.792 46.695h-0.962C410.88561 582.017 289.65061 563.617 189.27961 534.698 185.44461 533.595 177.87261 534.063 177.87261 534.063 166.64961 563.276 155.56661 593.696 147.44761 619.782 108.72961 744.168 121.27261 795.644 130.82461 796.798c20.496 2.474 79.78-93.637 79.78-93.637 0 97.66 88.324 247.617 290.576 248.996a718.01 718.01 0 0 1 5.367 0C708.80161 950.778 797.12261 800.822 797.12261 703.162c0 0 59.284 96.111 79.783 93.637 9.55-1.154 22.093-52.63-16.623-177.017" fill="#000000" p-id="4297"></path><path d="M434.38261 316.917c-27.9 1.24-51.745-30.106-53.24-69.956-1.518-39.877 19.858-73.207 47.764-74.454 27.875-1.224 51.703 30.109 53.218 69.974 1.527 39.877-19.853 73.2-47.742 74.436m206.67-69.956c-1.494 39.85-25.34 71.194-53.24 69.956-27.888-1.238-49.269-34.559-47.742-74.435 1.513-39.868 25.341-71.201 53.216-69.974 27.909 1.247 49.285 34.576 47.767 74.453" fill="#FFFFFF" p-id="4298"></path><path d="M683.94261 368.627c-7.323-17.609-81.062-37.227-172.353-37.227h-0.98c-91.29 0-165.031 19.618-172.352 37.227a6.244 6.244 0 0 0-0.535 2.505c0 1.269 0.393 2.414 1.006 3.386 6.168 9.765 88.054 58.018 171.882 58.018h0.98c83.827 0 165.71-48.25 171.881-58.016a6.352 6.352 0 0 0 1.002-3.395c0-0.897-0.2-1.736-0.531-2.498" fill="#FAAD08" p-id="4299"></path><path d="M467.63161 256.377c1.26 15.886-7.377 30-19.266 31.542-11.907 1.544-22.569-10.083-23.836-25.978-1.243-15.895 7.381-30.008 19.25-31.538 11.927-1.549 22.607 10.088 23.852 25.974m73.097 7.935c2.533-4.118 19.827-25.77 55.62-17.886 9.401 2.07 13.75 5.116 14.668 6.316 1.355 1.77 1.726 4.29 0.352 7.684-2.722 6.725-8.338 6.542-11.454 5.226-2.01-0.85-26.94-15.889-49.905 6.553-1.579 1.545-4.405 2.074-7.085 0.242-2.678-1.834-3.786-5.553-2.196-8.135" fill="#000000" p-id="4300"></path><path d="M504.33261 584.495h-0.967c-63.568 0.752-140.646-7.504-215.286-21.92-6.391 36.262-10.25 81.838-6.936 136.196 8.37 137.384 91.62 223.736 220.118 224.996H506.48461c128.498-1.26 211.748-87.612 220.12-224.996 3.314-54.362-0.547-99.938-6.94-136.203-74.654 14.423-151.745 22.684-215.332 21.927" fill="#FFFFFF" p-id="4301"></path><path d="M323.27461 577.016v137.468s64.957 12.705 130.031 3.91V591.59c-41.225-2.262-85.688-7.304-130.031-14.574" fill="#EB1C26" p-id="4302"></path><path d="M788.09761 432.536s-121.98 40.387-283.743 41.539h-0.962c-161.497-1.147-283.328-41.401-283.744-41.539l-40.854 106.952c102.186 32.31 228.837 53.135 324.598 51.926l0.96-0.002c95.768 1.216 222.4-19.61 324.6-51.924l-40.855-106.952z" fill="#EB1C26" p-id="4303"></path></svg></button>
<?php }?>
<?php if($conf['login_wx']>0 || $conf['login_wx']==-1){?>
<button type="button" class="btn btn-rounded btn-lg btn-icon btn-default" title="微信快捷登录" onclick="window.location.href='wxlogin.php'"><svg t="1685014830767" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9676" width="32" height="32"><path d="M1010.8 628c0-141.2-141.3-256.2-299.9-256.2-168 0-300.3 115.1-300.3 256.2 0 141.4 132.3 256.2 300.3 256.2 35.2 0 70.7-8.9 106-17.7l96.8 53-26.6-88.2c70.9-53.2 123.7-123.7 123.7-203.3zM618 588.8c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40c0 22-17.9 40-40 40z m194.3-0.3c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40z" fill="#00C800" p-id="9677"></path><path d="M366.3 106.9c-194.1 0-353.1 132.3-353.1 300.3 0 97 52.9 176.6 141.3 238.4l-35.3 106.2 123.4-61.9c44.2 8.7 79.6 17.7 123.7 17.7 11.1 0 22.1-0.5 33-1.4-6.9-23.6-10.9-48.3-10.9-74 0-154.3 132.5-279.5 300.2-279.5 11.5 0 22.8 0.8 34 2.1C692 212.6 539.9 106.9 366.3 106.9zM247.7 349.2c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48z m246.6 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48z" fill="#00C800" p-id="9678"></path></svg></button>
</div>
<?php }?>
<?php }?>
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
<!--验证码-->
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
var captcha_open = 0;
var handlerEmbed = function (captchaObj) {
	captchaObj.appendTo('#captcha');
	captchaObj.onReady(function () {
		$("#captcha_wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		$("#captchaform").html('<input type="hidden" name="geetest_challenge" value="'+result.geetest_challenge+'" /><input type="hidden" name="geetest_validate" value="'+result.geetest_validate+'" /><input type="hidden" name="geetest_seccode" value="'+result.geetest_seccode+'" />');
	});
};
$(document).ready(function(){
	if($("#captcha").length>0) captcha_open=1;
	$("#submit").click(function(){
		var type=$("input[name='type']").val();
		var user=$("input[name='user']").val();
		var pass=$("input[name='pass']").val();
		if(user=='' || pass==''){layer.alert(type==1?'账号和密码不能为空！':'ID和密钥不能为空！');return false;}
		submitLogin(type,user,pass);
	});
	if(captcha_open==1){
	$.ajax({
		url: "./ajax.php?act=captcha&t=" + (new Date()).getTime(),
		type: "get",
		dataType: "json",
		success: function (data) {
			$('#captcha_text').hide();
			$('#captcha_wait').show();
			initGeetest({
				gt: data.gt,
				challenge: data.challenge,
				new_captcha: data.new_captcha,
				product: "popup",
				width: "100%",
				offline: !data.success
			}, handlerEmbed);
		}
	});
	}
});
function submitLogin(type,user,pass){
	var csrf_token=$("input[name='csrf_token']").val();
	var data = {type:type, user:user, pass:pass, csrf_token:csrf_token};
	if(captcha_open == 1){
		var geetest_challenge = $("input[name='geetest_challenge']").val();
		var geetest_validate = $("input[name='geetest_validate']").val();
		var geetest_seccode = $("input[name='geetest_seccode']").val();
		if(geetest_challenge == ""){
			layer.alert('请先完成滑动验证！'); return false;
		}
		var adddata = {geetest_challenge:geetest_challenge, geetest_validate:geetest_validate, geetest_seccode:geetest_seccode};
	}
	var ii = layer.load();
	$.ajax({
		type: "POST",
		dataType: "json",
		data: Object.assign(data, adddata),
		url: "ajax.php?act=login",
		success: function (data, textStatus) {
			layer.close(ii);
			if (data.code == 0) {
				layer.msg(data.msg, {icon: 16,time: 10000,shade:[0.3, "#000"]});
				setTimeout(function(){ window.location.href=data.url }, 1000);
			}else{
				layer.alert(data.msg, {icon: 2});
			}
		},
		error: function (data) {
			layer.msg('服务器错误', {icon: 2});
			return false;
		}
	});
}
</script>

</body>
</html>