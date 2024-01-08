<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if(empty($userrow['account']) || empty($userrow['username'])){
	exit("<script language='javascript'>window.location.href='./completeinfo.php';</script>");
}

if($userrow['status']==0){
	$status = '<font color="red">已封禁</font>';
}elseif($userrow['pay']==0 && $userrow['settle']==0){
	$status = '<font color="red">关闭支付、结算</font>';
}elseif($userrow['pay']==0){
	$status = '<font color="red">关闭支付</font>';
}elseif($userrow['settle']==0){
	$status = '<font color="red">关闭结算</font>';
}elseif($conf['cert_force']==1 && $userrow['cert']==0){
	$status = '<a href="certificate.php"><font color="red">未实名</font></a>';
}elseif($userrow['pay']==2){
	$status = '<font color="orange">待审核</font>';
}else{
	$status = '<font color="green">正常</font>';
}
$title='用户中心';
include './head.php';
?>
<style>
.round {
    line-height: 53px;
    color: #7266ba;
    width: 58px;
    height: 58px;
    font-size: 26px;
    margin-left:15px;
    display: inline-block;
    font-weight: 400;
    border: 3px solid #f8f8fe;
    text-align: center;
    border-radius: 50%;
    background: #e3dff9;
}
</style>
<?php
$rs=$DB->query("SELECT * FROM pre_settle WHERE uid={$uid} AND status=1 ORDER BY id DESC LIMIT 9");
$max_settle=0;
$chart='';
$i=0;
while($row = $rs->fetch())
{
	if($row['money']>$max_settle)$max_settle=$row['money'];
	$chart.='['.$i++.','.$row['money'].'],';
}
$chart=substr($chart,0,-1);

$list = $DB->getAll("SELECT * FROM pre_anounce ORDER BY sort ASC");

$rates = \lib\Channel::getTypes($userrow['gid']);
?>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title">欢迎回来</h4>
					</div>
					<div class="modal-body">
<?php echo $conf['modal']?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

               

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="avatar-sm float-right">
                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="bx bx-layer m-0 h3 text-primary"></i>
                                        </span>
                                    </div>
                                    <h6 class="badge badge-soft-primary mr-1">商户当前余额</h6>
                                    <h3 class="my-3"><?php echo $userrow['money']?>$ </h3>
                                    <span class="text-muted">商户当前余额汇总</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="avatar-sm float-right">
                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="bx bx-dollar-circle m-0 h3 text-primary"></i>
                                        </span>
                                    </div>
                                    <h6 class="badge badge-soft-primary mr-1">已结算余额</h6>
                                    <h3 class="my-3"><span id="settle_money"></span>$ </h3>
                                    <span class="text-muted">商户已经结算金额汇总</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="avatar-sm float-right">
                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="bx bx-analyse m-0 h3 text-primary"></i>
                                        </span>
                                    </div>
                                    <h6 class="badge badge-soft-primary mr-1">订单总数</h6>
                                    <h3 class="my-3"> <span data-plugin="counterup"><span id="orders"></span>个</span></h3>
                                    <span class="text-muted">商户所有订单数量汇总</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="avatar-sm float-right">
                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="bx bx-basket m-0 h3 text-primary"></i>
                                        </span>
                                    </div>
                                    <h6 class="badge badge-soft-primary mr-1">今日订单 </h6>
                                    <h3 class="my-3" data-plugin="counterup"><span id="orders_today"> </span>个</h3>
                                    <span class="text-muted">商户今日订单数量汇总</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-8">
                             <div class="card card-animate">
                                <div class="card-body">
                                    <h4 class="card-title d-inline-block">经营数据</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>通道类型</th>
                                                    <th></th>
                                                    <th>时间</th>
                                                    
                                                    <th></th>
                                                    <th>收入</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <td><i class=""><img src="assets/img/alipay.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">支付宝</i></td>
                                                    <td></td>
                                                    <td>今日</td>
                                                    
                                                    <td></td>
                                                    <td class="text-warning"><span id="order_today_alipay"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>2</th>
                                                    <td><i class=""><img src="assets/img/wxpay.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">微信</i></td>
                                                    <td></td>
                                                    <td>今日</td>
                                                    
                                                    <td></td>
                                                    <td class="text-success"><span id="order_today_wxpay"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <td><i class=""><img src="assets/img/qqpay.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">QQ</i></td>
                                                    <td></td>
                                                    <td>今日</td>
                                                    <td></td>
                                                    
                                                    <td class="text-danger"><span id="order_today_qqpay"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <td><i class=""><img src="assets/img/alipay2.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">支付宝</i></td>
                                                    <td></td>
                                                    <td>昨日</td>
                                                    
                                                    <td></td>
                                                    <td class="text-warning"><span id="order_lastday_alipay"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>5</th>
                                                    <td><i class=""><img src="assets/img/wxpay2.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">微信</i></td>
                                                    <td></td>
                                                    <td>昨日</td>
                                                    
                                                    <td></td>
                                                    <td class="text-warning"><span id="order_lastday_wxpay"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>6</th>
                                                    <td><i class=""><img src="assets/img/qqpay2.png" style="margin-top: -6px;margin-bottom: -2px; height:30px">QQ</i></td>
                                                    <td></td>
                                                    <td>昨日</td>
                                                    
                                                    <td></td>
                                                    <td class="text-danger"><span id="order_lastday_qqpay"></span></td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
if($conf['cert_force']==1 && $userrow['cert']==0){
	echo '<div class="alert alert-danger"><span class="btn-sm btn-danger">重要</span>&nbsp;请完成实名认证，否则您的商户无法正常收款！ <a href="./certificate.php" class="btn btn-danger btn-sm waves-effect waves-light">立即实名认证</a></div>';
}
if($conf['verifytype']==1 && empty($userrow['phone'])){
	echo '<div class="alert alert-warning"><span class="btn-sm btn-warning">提示</span>&nbsp;您还没有绑定密保手机，请&nbsp;<a href="editinfo.php" class="btn btn-danger btn-sm waves-effect waves-light">尽快绑定</a></div>';
}elseif($conf['verifytype']==0 && empty($userrow['email'])){
	echo '<div class="alert alert-warning"><span class="btn-sm btn-warning">提示</span>&nbsp;您还没有绑定密保邮箱，请&nbsp;<a href="editinfo.php" class="btn btn-danger btn-sm waves-effect waves-light">尽快绑定</a></div>';
}
if(empty($userrow['pwd'])){
	echo '<div class="alert alert-warning"><span class="btn-sm btn-warning">提示</span>&nbsp;您还没有设置登录密码，请&nbsp;<a href="userinfo.php?mod=account" class="btn btn-danger btn-sm waves-effect waves-light">点此设置</a>，设置登录密码之后你就可以使用手机号/邮箱+密码登录</div>';
}
?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <!---->
                        
                        <div class="col-xl-3 col-lg-6">
                             <div class="card card-animate">
                                 <img class="card-img-top img-fluid" src="./AXMBGY3/mbwj/vertical/assets/images/girl-with-laptop.png">
                                
                                <div class="card-body">
                                    <h5 class="mb-1"><a href="" class="text-dark">欢迎：<?php echo $userrow['username']?>&nbsp;&nbsp;状态：<?php echo $status;?></a> </h5><hr>
                                    <!--<p class="text-muted font-size-13">UID：<?php echo $uid?></p>-->
                                    <h5 class="text-dark">今日收入:<span id="order_today_all"></span>$&nbsp;&nbsp;&nbsp;&nbsp;昨日收入:<span id="order_lastday_all"></span>$</h5>
                                         
                                    <table class="table table-striped">   
		                                  <thead><tr>
		                                  <?php foreach($rates as $row){?>
		                                  
			                              <th style="text-align:center;"><img src="/assets/icon/<?php echo $row['name']?>.ico" width="18px">&nbsp;<?php echo $row['showname']?></th>
		                                  <?php }?>
		                                  </tr></thead><tbody><tr>
		                                  <?php foreach($rates as $row){?>
			                              <td><?php echo (100-$row['rate'])?>%</td>
		                                  <?php }?>
		                                  </tr></tbody>
		                                </table>
                                </div>
                            </div> <!-- end card-->
                        </div>
                        <div class="col-lg-8">
                             <div class="card card-animate">
                                <div class="card-body">
                                    <h4 class="card-title d-inline-block mb-3">公告通知</h4>
                                    
                                    <div data-simplebar style="max-height: 380px;">
                                    <?php foreach($list as $row){?>
			                        <a class="list-group-item"> <svg t="1694616330638" class="icon" viewBox="0 0 1126 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="17448" width="32" height="32"><path d="M1015.797242 1024H110.300197a110.333815 110.333815 0 0 1-110.216152-110.266579V51.771504A51.687459 51.687459 0 0 1 51.737886 0.168089h2.336441a51.855548 51.855548 0 0 1 33.466579 12.270519L163.046619 70.261326 229.811687 13.447144a51.502561 51.502561 0 0 1 66.933159 0l66.74826 56.814182L430.241366 13.447144a51.502561 51.502561 0 0 1 66.933158 0l66.765069 56.814182L630.687853 13.447144a51.502561 51.502561 0 0 1 66.933158 0l66.74826 56.814182L831.117531 13.447144a51.502561 51.502561 0 0 1 66.933158 0l66.647407 56.646093L1040.775312 12.606697a51.620223 51.620223 0 0 1 85.238083 39.164807v861.961917a110.333815 110.333815 0 0 1-110.216153 110.266579zM100.937623 145.229153v771.025607a6.858043 6.858043 0 0 0 6.90847 6.891662h910.422062a6.874852 6.874852 0 0 0 6.90847-6.891662V147.750492l-23.061852 19.666448a56.612475 56.612475 0 0 1-70.765594 0.16809l-66.765069-56.814183-66.74826 56.814183a51.502561 51.502561 0 0 1-66.933158 0l-66.74826-56.814183-66.74826 56.814183a51.502561 51.502561 0 0 1-66.933158 0l-66.765069-56.814183-66.765069 56.814183a51.485752 51.485752 0 0 1-66.916349 0l-66.74826-56.814183-66.765069 56.814183a51.502561 51.502561 0 0 1-66.933159 0z m133.614183 138.84176h54.34327l55.250952 97.155614 21.851608 45.047931h1.495995a584.816284 584.816284 0 0 1-7.160604-74.967826v-67.235719h50.746159v203.051871H356.685489l-54.948391-97.99606-21.851609-44.375575h-1.479186a742.803414 742.803414 0 0 1 6.858044 74.967827v67.403808h-50.762968V284.070913z m228.113985 0h140.959685v40.50952h-87.507288v37.652003h74.362705v40.845699h-74.362705v43.03086h90.76822v41.013789h-144.237426V284.070913z m166.610112 0h54.662639l14.018648 92.617203 8.959159 64.3782h1.193434c4.185424-21.683519 8.673408-43.367039 13.144583-64.3782l22.708864-92.617203h44.778989l23.297177 92.617203c4.471175 20.674984 8.404465 42.526592 12.842022 64.3782h1.479186c2.706238-21.851609 5.681418-43.367039 8.404465-64.3782l14.338017-92.617203h50.762968l-38.526067 203.051871h-67.235719l-20.019435-88.41497c-3.580302-15.464215-6.572292-31.936967-8.656599-47.233093h-1.462377c-2.706238 15.296126-5.395666 31.768877-8.673408 47.233093l-19.397505 88.41497h-66.008667z m261.227577 369.292186h-655.043992v-83.70847h655.043992v83.70847z m-201.9761 152.288904H235.459488v-84.885096h453.067892v84.885096z" fill="#32A0F0" p-id="17449"></path></svg>&nbsp;&nbsp;<font color="<?php echo $row['color']?$row['color']:null?>"><?php echo $row['content']?></font><span class="text-xs text-muted">&nbsp;-<?php echo $row['addtime']?></span></a>
                                    <?php }?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </div>
                    <!-- end row-->
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- Overlay-->
    <div class="menu-overlay"></div>

<script>
$(document).ready(function(){
	$.ajax({
		type : "GET",
		url : "ajax2.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#orders').html(data.orders);
			$('#orders_today').html(data.orders_today);
			$('#settle_money').html(data.settle_money);
			$('#order_today_all').html(data.order_today.all);
			$('#order_today_alipay').html(data.order_today.alipay);
			$('#order_today_wxpay').html(data.order_today.wxpay);
			$('#order_today_qqpay').html(data.order_today.qqpay);
			$('#order_lastday_all').html(data.order_lastday.all);
			$('#order_lastday_alipay').html(data.order_lastday.alipay);
			$('#order_lastday_wxpay').html(data.order_lastday.wxpay);
			$('#order_lastday_qqpay').html(data.order_lastday.qqpay);
		}
	});
	<?php if(!empty($conf['modal'])){?>
	$('#myModal').modal('show');
	<?php }?>
});
</script>