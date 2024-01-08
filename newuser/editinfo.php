<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='个人资料';
include './head.php';
?>
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:'api';

if(strlen($userrow['phone'])==11){
	$userrow['phone']=substr($userrow['phone'],0,3).'****'.substr($userrow['phone'],7,10);
}

?>
<div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">
                         <div class="card">
                             <div class="card-body">
                                 <h4 class="card-title">个人资料</h4>
                  <p class="card-subtitle mb-4">在此处修改自己的资料</p>
                    <!--<div class="row">-->
                    <!--  <div class="col-12">-->
                    <!--    <div class="card">-->
                    <!---->
                    <input type="hidden" id="situation" value="">

 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title">验证密保信息</h4>
					</div>
					<div class="modal-body">
<?php if($conf['verifytype']==1){?>
<div class="list-group-item">密保手机：<?php echo $userrow['phone']?></div>
<div class="list-group-item">
<div class="input-group">
<input type="text" name="code" placeholder="输入短信验证码" class="form-control" required>
<a class="input-group-addon" id="sendcode">获取验证码</a>
</div>
</div>
<?php }else{?>
<div class="list-group-item">密保邮箱：<?php echo $userrow['email']?></div>
<div class="list-group-item">
<div class="input-group">
<input type="text" name="code" placeholder="输入验证码" class="form-control" required>
<a class="input-group-addon" id="sendcode">获取验证码</a>
</div>
</div>
<?php }?>
<button type="button" id="verifycode" class="btn btn-primary btn-block">确定</button>
<div id="embed-captcha"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title">修改密保信息</h4>
					</div>
					<div class="modal-body">
<?php if($conf['verifytype']==1){?>
<div class="list-group-item">
<input type="text" name="phone_n" placeholder="输入新的手机号码" class="form-control" required>
</div>
<div class="list-group-item">
<div class="input-group">
<input type="text" name="code_n" placeholder="输入短信验证码" class="form-control" required>
<a class="input-group-addon" id="sendcode2">获取验证码</a>
</div>
</div>
<?php }else{?>
<div class="list-group-item">
<input type="email" name="email_n" placeholder="输入新的邮箱" class="form-control" required>
</div>
<div class="list-group-item">
<div class="input-group">
<input type="text" name="code_n" placeholder="输入验证码" class="form-control" required>
<a class="input-group-addon" id="sendcode2">获取验证码</a>
</div>
</div>
<?php }?>
<button type="button" id="editBind" class="btn btn-primary btn-block">确定</button>
<div id="embed-captcha"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal inmodal fade" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title">修改手机号码</h4>
					</div>
					<div class="modal-body">
<div class="list-group-item">
<input type="text" name="phone_s" placeholder="输入新的手机号码" class="form-control" required>
</div>
<div class="list-group-item">
<div class="input-group">
<input type="text" name="code_s" placeholder="输入短信验证码" class="form-control" required>
<a class="input-group-addon" id="sendcode3">获取验证码</a>
</div>
</div>
<button type="button" id="editBindPhone" class="btn btn-primary btn-block">确定</button>
<div id="embed-captcha"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
<div class="tab-container ng-isolate-scope">
<ul class="nav nav-tabs">
	<li style="width: 25%;" align="center">
		<a href="userinfo.php?mod=api">API信息</a>
	</li>
	<li style="width: 25%;" align="center" class="active">
		<a href="editinfo.php">修改资料</a>
	</li>
	<li style="width: 25%;" align="center">
		<a href="userinfo.php?mod=account">修改密码</a>
	</li>
	<?php if($conf['cert_open']>0){?>
	<li style="width: 25%;" align="center">
		<a href="certificate.php">实名认证</a>
	</li>
	<?php }?>
</ul><br>
	<div class="tab-content">
		<div class="tab-pane ng-scope active">
			<form class="form-horizontal devform">
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>收款账号设置：</h4></div></div>
				<div class="form-group">
					<label class="col-sm-2 control-label">结算方式</label>
					<div class="col-sm-9">
						<select class="form-control" name="stype" default="<?php echo $userrow['settle_id']?>">
						<?php if($conf['settle_alipay']){?><option value="1" input="支付宝账号">支付宝结算</option>
						<?php }if($conf['settle_wxpay']){?><option value="2" input="<?php echo $conf['transfer_wxpay']?'微信OpenId':'微信号';?>">微信结算</option>
						<?php }if($conf['settle_qqpay']){?><option value="3" input="ＱＱ号码">QQ钱包结算</option>
						<?php }if($conf['settle_bank']){?><option value="4" input="银行卡号">银行卡结算</option>
						<?php }?></select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" id="typename">收款账号</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="account" value="<?php echo $userrow['account']?>">
					</div>
				</div>
				<?php if($conf['transfer_wxpay']){?>
				<div class="form-group" style="display:none;" id="getopenid_form">
					<div class="col-sm-offset-2 col-sm-4">
						<a class="btn btn-sm btn-default" id="getopenid">点此获取微信OpenId</a>
					</div>
				</div>
				<?php }?>
				<div class="form-group">
					<label class="col-sm-2 control-label">真实姓名</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="username" value="<?php echo $userrow['username']?>">
					</div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="button" id="editSettle" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				</div>

				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>联系方式设置：</h4></div></div>
				<?php if($conf['verifytype']==1){?>
				<div class="form-group">
					<label class="col-sm-2 control-label">手机号码</label>
					<div class="col-sm-9">
						<div class="input-group">
						<input class="form-control" type="text" name="phone" value="<?php echo $userrow['phone']?>" disabled>
						<a class="input-group-addon" id="checkbind">修改绑定</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">邮箱</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="email" value="<?php echo $userrow['email']?>">
					</div>
				</div>
				<?php }else{?>
				<div class="form-group">
					<label class="col-sm-2 control-label">邮箱</label>
					<div class="col-sm-9">
						<div class="input-group">
						<input class="form-control" type="text" name="email" value="<?php echo $userrow['email']?>" disabled>
						<a class="input-group-addon" id="checkbind">修改绑定</a>
						</div>
					</div>
				</div>
				<?php if(!empty($conf['sms_appkey'])){?><div class="form-group">
					<label class="col-sm-2 control-label">手机号码</label>
					<div class="col-sm-9">
						<div class="input-group">
						<input class="form-control" type="text" name="phone" value="<?php echo $userrow['phone']?>" disabled>
						<a class="input-group-addon" id="bindphone">修改绑定</a>
						</div>
					</div>
				</div>
				<?php }}?>
				<div class="form-group">
					<label class="col-sm-2 control-label">ＱＱ</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="qq" value="<?php echo $userrow['qq']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">网站域名</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="url" value="<?php echo $userrow['url']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">开启密钥登录</label>
					<div class="col-sm-9">
						<select class="form-control" name="keylogin" default="<?php echo $userrow['keylogin']?>"><option value="0">关闭</option><option value="1">开启</option></select>
					</div>
				</div>
				<?php if($conf['user_refund']==1){?>
				<div class="form-group">
					<label class="col-sm-2 control-label">订单退款API接口</label>
					<div class="col-sm-9">
						<select class="form-control" name="refund" default="<?php echo $userrow['refund']?>"><option value="0">关闭</option><option value="1">开启</option></select>
					</div>
				</div><?php }?>
				
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="button" id="editInfo" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				</div>

<?php if($conf['wxnotice']==1){
	$userrow['msgconfig'] = unserialize($userrow['msgconfig']);
?>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>微信消息提醒设置：</h4><?php if(!$userrow['wx_uid']){?><font color="#ff7373">需要先绑定微信才可以收到消息提醒</font><?php }?></div></div>
				<?php if($conf['wxnotice_tpl_order']){?><div class="form-group">
					<label class="col-sm-2 control-label">新订单通知</label>
					<div class="col-sm-9">
						<select class="form-control" name="notice_order" default="<?php echo $userrow['msgconfig']['order']?>"><option value="0">关闭</option><option value="1">开启</option></select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">通知订单金额大于</label>
					<div class="col-sm-9">
					<div class="input-group"><input class="form-control" type="text" name="notice_order_money" value="<?php echo $userrow['msgconfig']['order_money']?>"><span class="input-group-addon">元</span></div>
					</div>
				</div><?php }?>
				<?php if($conf['wxnotice_tpl_settle']){?><div class="form-group">
					<label class="col-sm-2 control-label">结算通知</label>
					<div class="col-sm-9">
						<select class="form-control" name="notice_settle" default="<?php echo $userrow['msgconfig']['settle']?>"><option value="0">关闭</option><option value="1">开启</option></select>
					</div>
				</div><?php }?>
				<?php if($conf['wxnotice_tpl_login']){?><div class="form-group">
					<label class="col-sm-2 control-label">登录通知</label>
					<div class="col-sm-9">
						<select class="form-control" name="notice_login" default="<?php echo $userrow['msgconfig']['login']?>"><option value="0">关闭</option><option value="1">开启</option></select>
					</div>
				</div><?php }?>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="button" id="editMsgConfig" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				</div>
<?php }?>

<?php
if($conf['user_settings_edit']){
$group_settings=$DB->getColumn("SELECT settings FROM pre_group WHERE gid='{$userrow['gid']}' LIMIT 1");
if(!$group_settings)$group_settings=$DB->getColumn("SELECT settings FROM pre_group WHERE gid=0 LIMIT 1");
$channelinfo = json_decode($userrow['channelinfo'], true);
if($group_settings){
?>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>自定义接口信息设置：</h4></div></div>

<?php foreach(explode(',',$group_settings) as $row){
	$arr = explode(':', $row);
	echo '<div class="form-group">
<label class="col-sm-2 control-label">'.$arr[1].'</label>
<div class="col-sm-9"><input type="text" class="form-control" name="setting['.$arr[0].']" value="'.$channelinfo[$arr[0]].'" required></div>
</div>';
}?>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="button" id="editChannelInfo" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				</div>
<?php }}?>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>支付手续费扣除模式选择：</h4></div></div>
				<div class="form-group has-success">
					<div class="col-sm-offset-2 col-sm-9">
					<div class="alert alert-success">
					1、余额扣费 (经典模式，默认)：例如费率1%，客户购买100元商品，客户需支付100元，卖家到账99元，手续费1元由卖家支付<br>            2、订单加费 (奸商模式)：例如费率1%，客户购买100元商品，客户需支付101元，卖家到账100元，手续费1元由买家支付
					  </div>
						<select class="form-control" name="mode" default="<?php echo $userrow['mode']?>">
								<option value="0">余额扣费</option>
								<option value="1">订单加费</option>
							  </select>
					</div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-4"><input type="button" id="editMode" value="确定修改" class="btn btn-primary form-control"/><br/>
				 </div>
				</div>

				 <div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group"><div class="col-sm-offset-2 col-sm-4"><h4>第三方账号绑定：</h4></div></div>
				<?php if($conf['login_qq']>0){?>
				<div class="form-group">
					<div class="col-xs-6"><span class="pull-right"><svg t="1685014769821" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4293" width="32" height="32"><path d="M511.09761 957.257c-80.159 0-153.737-25.019-201.11-62.386-24.057 6.702-54.831 17.489-74.252 30.864-16.617 11.439-14.546 23.106-11.55 27.816 13.15 20.689 225.583 13.211 286.912 6.767v-3.061z" fill="#FAAD08" p-id="4294"></path><path d="M496.65061 957.257c80.157 0 153.737-25.019 201.11-62.386 24.057 6.702 54.83 17.489 74.253 30.864 16.616 11.439 14.543 23.106 11.55 27.816-13.15 20.689-225.584 13.211-286.914 6.767v-3.061z" fill="#FAAD08" p-id="4295"></path><path d="M497.12861 474.524c131.934-0.876 237.669-25.783 273.497-35.34 8.541-2.28 13.11-6.364 13.11-6.364 0.03-1.172 0.542-20.952 0.542-31.155C784.27761 229.833 701.12561 57.173 496.64061 57.162 292.15661 57.173 209.00061 229.832 209.00061 401.665c0 10.203 0.516 29.983 0.547 31.155 0 0 3.717 3.821 10.529 5.67 33.078 8.98 140.803 35.139 276.08 36.034h0.972z" fill="#000000" p-id="4296"></path><path d="M860.28261 619.782c-8.12-26.086-19.204-56.506-30.427-85.72 0 0-6.456-0.795-9.718 0.148-100.71 29.205-222.773 47.818-315.792 46.695h-0.962C410.88561 582.017 289.65061 563.617 189.27961 534.698 185.44461 533.595 177.87261 534.063 177.87261 534.063 166.64961 563.276 155.56661 593.696 147.44761 619.782 108.72961 744.168 121.27261 795.644 130.82461 796.798c20.496 2.474 79.78-93.637 79.78-93.637 0 97.66 88.324 247.617 290.576 248.996a718.01 718.01 0 0 1 5.367 0C708.80161 950.778 797.12261 800.822 797.12261 703.162c0 0 59.284 96.111 79.783 93.637 9.55-1.154 22.093-52.63-16.623-177.017" fill="#000000" p-id="4297"></path><path d="M434.38261 316.917c-27.9 1.24-51.745-30.106-53.24-69.956-1.518-39.877 19.858-73.207 47.764-74.454 27.875-1.224 51.703 30.109 53.218 69.974 1.527 39.877-19.853 73.2-47.742 74.436m206.67-69.956c-1.494 39.85-25.34 71.194-53.24 69.956-27.888-1.238-49.269-34.559-47.742-74.435 1.513-39.868 25.341-71.201 53.216-69.974 27.909 1.247 49.285 34.576 47.767 74.453" fill="#FFFFFF" p-id="4298"></path><path d="M683.94261 368.627c-7.323-17.609-81.062-37.227-172.353-37.227h-0.98c-91.29 0-165.031 19.618-172.352 37.227a6.244 6.244 0 0 0-0.535 2.505c0 1.269 0.393 2.414 1.006 3.386 6.168 9.765 88.054 58.018 171.882 58.018h0.98c83.827 0 165.71-48.25 171.881-58.016a6.352 6.352 0 0 0 1.002-3.395c0-0.897-0.2-1.736-0.531-2.498" fill="#FAAD08" p-id="4299"></path><path d="M467.63161 256.377c1.26 15.886-7.377 30-19.266 31.542-11.907 1.544-22.569-10.083-23.836-25.978-1.243-15.895 7.381-30.008 19.25-31.538 11.927-1.549 22.607 10.088 23.852 25.974m73.097 7.935c2.533-4.118 19.827-25.77 55.62-17.886 9.401 2.07 13.75 5.116 14.668 6.316 1.355 1.77 1.726 4.29 0.352 7.684-2.722 6.725-8.338 6.542-11.454 5.226-2.01-0.85-26.94-15.889-49.905 6.553-1.579 1.545-4.405 2.074-7.085 0.242-2.678-1.834-3.786-5.553-2.196-8.135" fill="#000000" p-id="4300"></path><path d="M504.33261 584.495h-0.967c-63.568 0.752-140.646-7.504-215.286-21.92-6.391 36.262-10.25 81.838-6.936 136.196 8.37 137.384 91.62 223.736 220.118 224.996H506.48461c128.498-1.26 211.748-87.612 220.12-224.996 3.314-54.362-0.547-99.938-6.94-136.203-74.654 14.423-151.745 22.684-215.332 21.927" fill="#FFFFFF" p-id="4301"></path><path d="M323.27461 577.016v137.468s64.957 12.705 130.031 3.91V591.59c-41.225-2.262-85.688-7.304-130.031-14.574" fill="#EB1C26" p-id="4302"></path><path d="M788.09761 432.536s-121.98 40.387-283.743 41.539h-0.962c-161.497-1.147-283.328-41.401-283.744-41.539l-40.854 106.952c102.186 32.31 228.837 53.135 324.598 51.926l0.96-0.002c95.768 1.216 222.4-19.61 324.6-51.924l-40.855-106.952z" fill="#EB1C26" p-id="4303"></path></svg>&nbsp;&nbsp;&nbsp;ＱＱ快捷登录&nbsp;&nbsp;&nbsp;</span></div>
					<div class="col-xs-6">
					<?php if($userrow['qq_uid']){?>
						<a class="btn btn-sm btn-success" disabled title="<?php echo $userrow['qq_uid']?>">已绑定</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="./connect.php?unbind=1" onclick="return confirm('解绑后将无法通过QQ一键登录，是否确定解绑？');">解绑</a>
					<?php }else{?>
						<a class="btn btn-sm btn-success" href="javascript:connect('qq')">立即绑定</a>
					<?php }?>
					</div>
				</div>
				<?php }?>
				<?php if($conf['login_wx']!=0){?>
				<div class="form-group">
					<div class="col-xs-6"><span class="pull-right"><svg t="1685014830767" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9676" width="32" height="32"><path d="M1010.8 628c0-141.2-141.3-256.2-299.9-256.2-168 0-300.3 115.1-300.3 256.2 0 141.4 132.3 256.2 300.3 256.2 35.2 0 70.7-8.9 106-17.7l96.8 53-26.6-88.2c70.9-53.2 123.7-123.7 123.7-203.3zM618 588.8c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40c0 22-17.9 40-40 40z m194.3-0.3c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40z" fill="#00C800" p-id="9677"></path><path d="M366.3 106.9c-194.1 0-353.1 132.3-353.1 300.3 0 97 52.9 176.6 141.3 238.4l-35.3 106.2 123.4-61.9c44.2 8.7 79.6 17.7 123.7 17.7 11.1 0 22.1-0.5 33-1.4-6.9-23.6-10.9-48.3-10.9-74 0-154.3 132.5-279.5 300.2-279.5 11.5 0 22.8 0.8 34 2.1C692 212.6 539.9 106.9 366.3 106.9zM247.7 349.2c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48z m246.6 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48z" fill="#00C800" p-id="9678"></path></svg>&nbsp;&nbsp;&nbsp;微信快捷登录&nbsp;&nbsp;&nbsp;</span></div>
					<div class="col-xs-6">
					<?php if($userrow['wx_uid']){?>
						<a class="btn btn-sm btn-success" disabled title="<?php echo $userrow['wx_uid']?>">已绑定</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="./wxlogin.php?unbind=1" onclick="return confirm('解绑后将无法通过微信一键登录，是否确定解绑？');">解绑</a>
					<?php }else{?>
						<a class="btn btn-sm btn-success" href="javascript:connect('wx')">立即绑定</a>
					<?php }?>
					</div>
				</div>
				<?php }?>
				<?php if($conf['login_alipay']!=0){?>
				<div class="form-group">
					<div class="col-xs-6"><span class="pull-right"><i class="fa fa-2x"><img src="/assets/icon/alipay.ico" style="border-radius:50px;"></i>&nbsp;&nbsp;支付宝快捷登录</span></div>
					<div class="col-xs-6">
					<?php if($userrow['alipay_uid']){?>
						<a class="btn btn-sm btn-success" disabled title="<?php echo $userrow['alipay_uid']?>">已绑定</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="./oauth.php?unbind=1" onclick="return confirm('解绑后将无法通过支付宝一键登录，是否确定解绑？');">解绑</a>
					<?php }else{?>
						<a class="btn btn-sm btn-success" href="javascript:connect('alipay')">立即绑定</a>
					<?php }?>
					</div>
				</div>
				<?php }?>
			</form>
		</div>
	</div>
</div>
</div>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
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
	var target;
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var situation=$("#situation").val();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=sendcode",
			data : {situation:situation,target:target,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendcode");
					new invokeSettime("#sendcode2");
					new invokeSettime("#sendcode3");
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
		captchaObj.verify();
	});
	$('#sendcode2').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		if($("input[name='phone_n']").length>0){
			target=$("input[name='phone_n']").val();
			if(target==''){layer.alert('手机号码不能为空！');return false;}
			if(target.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			target=$("input[name='email_n']").val();
			if(target==''){layer.alert('邮箱不能为空！');return false;}
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(target)){layer.alert('邮箱格式不正确！');return false;}
		}
		captchaObj.verify();
	});
	$('#sendcode3').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		target=$("input[name='phone_s']").val();
		if(target==''){layer.alert('手机号码不能为空！');return false;}
		if(target.length!=11){layer.alert('手机号码不正确！');return false;}
		captchaObj.verify();
	})
	// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
	var items = $("select[default]");
	for (i = 0; i < items.length; i++) {
		$(items[i]).val($(items[i]).attr("default")||0);
	}
	$("select[name='stype']").change(function(){
		var input = $("select[name='stype'] option:selected").attr("input");
		$("#typename").html(input);
		if($(this).val() == 2){
			$("#getopenid_form").show();
		}else{
			$("#getopenid_form").hide();
		}
	});
	$("select[name='stype']").change();
	$("#editSettle").click(function(){
		var stype=$("select[name='stype']").val();
		var account=$("input[name='account']").val();
		var username=$("input[name='username']").val();
		if(account=='' || username==''){layer.alert('请确保各项不能为空！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_settle",
			data : {stype:stype,account:account,username:username},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！', {icon:1});
				}else if(data.code == 2){
					$("#situation").val("settle");
					$('#myModal').modal('show');
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editInfo").click(function(){
		var email=$("input[name='email']").val();
		var qq=$("input[name='qq']").val();
		var url=$("input[name='url']").val();
		var keylogin=$("select[name='keylogin']").val();
		var refund=$("select[name='refund']").val();
		if(email=='' || qq=='' || url==''){layer.alert('请确保各项不能为空！');return false;}
		if(email.length>0){
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		}
		if (url.indexOf(" ")>=0){
			url = url.replace(/ /g,"");
		}
		if (url.toLowerCase().indexOf("http://")==0){
			url = url.slice(7);
		}
		if (url.toLowerCase().indexOf("https://")==0){
			url = url.slice(8);
		}
		if (url.slice(url.length-1)=="/"){
			url = url.slice(0,url.length-1);
		}
		$("input[name='url']").val(url);
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_info",
			data : {email:email,qq:qq,url:url,keylogin:keylogin,refund:refund},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！', {icon:1});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editChannelInfo").click(function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		var setting = {};
		$("input[name^='setting']").each(function(i, el) {
			setting[el.name] =$(this).val();
		});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_channel_info",
			data : setting,
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！', {icon:1});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editMode").click(function(){
		var mode=$("select[name='mode']").val();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_mode",
			data : {mode:mode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！', {icon:1});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editMsgConfig").click(function(){
		var notice_order=$("select[name='notice_order']").val();
		var notice_settle=$("select[name='notice_settle']").val();
		var notice_login=$("select[name='notice_login']").val();
		var notice_order_money=$("input[name='notice_order_money']").val();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_msgconfig",
			data : {notice_order:notice_order, notice_settle:notice_settle, notice_login:notice_login, notice_order_money:notice_order_money},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！', {icon:1});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#checkbind").click(function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "GET",
			url : "ajax2.php?act=checkbind",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					$("#situation").val("bind");
					$('#myModal2').modal('show');
				}else if(data.code == 2){
					$("#situation").val("mibao");
					$('#myModal').modal('show');
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editBind").click(function(){
		var phone=$("input[name='phone_n']").val();
		var email=$("input[name='email_n']").val();
		var code=$("input[name='code_n']").val();
		if(code==''){layer.alert('请输入验证码！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_bind",
			data : {phone:phone,email:email,code:code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改绑定成功！', {icon:1}, function(){window.location.reload()});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editBindPhone").click(function(){
		var phone=$("input[name='phone_s']").val();
		var code=$("input[name='code_s']").val();
		if(code==''){layer.alert('请输入验证码！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_bind",
			data : {phone:phone,code:code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改绑定成功！', {icon:1}, function(){window.location.reload()});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#verifycode").click(function(){
		var code=$("input[name='code']").val();
		var situation=$("#situation").val();
		if(code==''){layer.alert('请输入验证码！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=verifycode",
			data : {code:code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.msg('验证成功！', {icon:1});
					$('#myModal').modal('hide');
					if(situation=='settle'){
						$("#editSettle").click();
					}else if(situation=='mibao'){
						$("#situation").val("bind");
						$('#myModal2').modal('show');
					}else if(situation=='bind'){
						$('#myModal2').modal('hide');
						window.location.reload();
					}
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#bindphone").click(function(){
		$("#situation").val("bindphone");
		$('#myModal3').modal('show');
	});
	$('#getopenid').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		$(this).attr("data-lock", "true");
		$.ajax({
			type : "GET",
			url : "ajax.php?act=qrcode",
			dataType : 'json',
			success : function(data) {
				$('#getopenid').attr("data-lock", "false");
				if(data.code == 0){
					$.openidform = layer.open({
					  type: 1,
					  title: '请使用微信扫描以下二维码',
					  skin: 'layui-layer-demo',
					  anim: 2,
					  shadeClose: true,
					  content: '<div id="qrcode" class="list-group-item text-center"></div>',
					  success: function(){
						$('#qrcode').qrcode({
							text: data.url,
							width: 230,
							height: 230,
							foreground: "#000000",
							background: "#ffffff",
							typeNumber: -1
						});
						$.ostart = true;
						setTimeout('checkopenid()', 2000);
					  },
					  end: function(){
						$.ostart = false;
					  }
					});
				}else{
					layer.alert(data.msg, {icon: 0});
				}
			},
			error:function(data){
				layer.msg('服务器错误', {icon: 2});
				return false;
			}
		});
	});
	$.ajax({
		url: "ajax.php?act=captcha&t=" + (new Date()).getTime(),
		type: "get",
		asysn: true,
		dataType: "json",
		success: function (data) {
			console.log(data);
			initGeetest({
				width: '100%',
				gt: data.gt,
				challenge: data.challenge,
				new_captcha: data.new_captcha,
				product: "bind",
				offline: !data.success
			}, handlerEmbed);
		}
	});
});
function checkopenid(){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "ajax.php?act=getopenid",
		success: function (data, textStatus) {
			if (data.code == 0) {
				layer.msg('Openid获取成功');
				layer.close($.openidform);
				$("input[name='account']").val(data.openid);
			}else if($.ostart==true){
				setTimeout('checkopenid()', 2000);
			}else{
				return false;
			}
		},
		error: function (data) {
			layer.msg('服务器错误', {icon: 2});
			return false;
		}
	});
}
function connect(type){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=connect",
		data : {type:type, bind:'1'},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				window.location.href = data.url;
			}else{
				layer.alert(data.msg, {icon: 7});
			}
		} 
	});
}
</script>