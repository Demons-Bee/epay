<?php
include("ophead.php");
@header('Content-Type: text/html; charset=UTF-8');
if($userrow['status']==0){
	sysmsg('你的商户由于违反相关法律法规与《<a href="/?mod=agreement">'.$conf['sitename'].'用户协议</a>》，已被禁用！');
}
switch($conf['user_style']){
	case 1: $style=['bg-black','bg-black','bg-white']; break;
	case 2: $style=['bg-dark','bg-white','bg-dark']; break;
	case 3: $style=['bg-dark','bg-dark','bg-light']; break;
	case 4: $style=['bg-info','bg-info','bg-black']; break;
	case 5: $style=['bg-info','bg-info','bg-white']; break;
	case 6: $style=['bg-primary','bg-primary','bg-dark']; break;
	case 7: $style=['bg-primary','bg-primary','bg-white']; break;
	default: $style=['bg-black','bg-white','bg-black']; break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title?> | <?php echo $conf['sitename']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App css -->
    <link href="./AXMBGY3/mbwj/vertical/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="./AXMBGY3/mbwj/vertical/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">



</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="index.html" class="logo">
                        <img src="/assets/img/logo.png"style="width:170px;height:50px;" />
                    </a>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">控制台</li>

                        <li>
                            <a href="./" class="waves-effect"><i class='bx bx-home-smile'></i><span class="badge badge-pill badge-primary float-right">首</span><span>用户中心</span></a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-user-circle"></i><span>用户信息</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="userinfo.php?mod=api">API信息</a></li>
                                <li><a href="editinfo.php">修改资料</a></li>
                                <li><a href="userinfo.php?mod=account">修改密码</a>
                                 <?php if($conf['cert_open']>0){?>
                                <li><a href="certificate.php">实名认证</a> <?php }?>
                            </ul>
                        </li>
                        <li class="menu-title">功能列表</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-file"></i><span>交易记录</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="order.php">订单记录</a></li>
                                <li><a href="settle.php">结算记录</a></li>
                                <li><a href="record.php">资金明细</a></li>
                                
                                
                            </ul>
                        </li>
                          <?php if($conf['settle_open']==2||$conf['settle_open']==3){?>
                        <li><a href="apply.php" class=" waves-effect"><i class="bx bx-calendar"></i><span>申请提现</span></a></li><?php }?><?php if($conf['recharge']==1){?>
                        <li><a href="recharge.php" class=" waves-effect"><i class="bx bx-aperture"></i><span>余额充值</span></a></li><?php }?><?php if($conf['group_buy']==1){?>
                        <li><a href="groupbuy.php" class=" waves-effect"><i class="bx bx-calendar"></i><span>购买会员</span></a></li><?php }?><?php if($conf['pay_domain_open']==1){?>
                        <li><a href="domain.php" class=" waves-effect"><i class="bx bx-calendar"></i><span>授权域名</span></a></li><?php }?><?php if($conf['user_transfer']==1){?>
                        <li><a href="transfer.php" class=" waves-effect"><i class="bx bx-layout"></i><span>代付管理</span></a></li><?php }?> <?php if($conf['onecode']==1){?>
                        <li><a href="onecode.php" class=" waves-effect"><i class="bx bx-calendar"></i><span>聚合收款</span></a></li> <?php }?>
<li class="menu-title">其他功能</li>
 <li><a href="/doc.html" class=" waves-effect"><i class="bx bx-calendar"></i><span>开发文档</span></a></li><?php if(!empty($conf['qqqun'])){?>
                        <li><a href="<?php echo $conf['qqqun']?>" class=" waves-effect"><i class="bx bx-calendar"></i><span>产品QQ群</span></a></li> <?php }?><?php if(!empty($conf['appurl'])){?>
                        <li><a href="<?php echo $conf['appurl']?>" class=" waves-effect"><i class="bx bx-calendar"></i><span>APP下载</span></a></li><?php }?>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        
         
        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-none d-sm-inline-block ml-2">
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?php echo ($userrow['qq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/img/user.png'?>">
                            <span class="d-none d-sm-inline-block ml-1">UID:<?php echo $uid?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="login.php?logout">
                                <span>退出登录</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.min.js"></script>
<script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="./assets/js/ui-load.js"></script>
<script src="./assets/js/ui-jp.config.js"></script>
<script src="./assets/js/ui-jp.js"></script>
<script src="./assets/js/ui-nav.js"></script>
<script src="./assets/js/ui-toggle.js"></script>
<script src="//cdn.bootcdn.net/ajax/libs/jsrsasign/10.6.1/jsrsasign-all-min.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/jquery.min.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/bootstrap.bundle.min.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/metismenu.min.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/waves.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/simplebar.min.js"></script>
<script src="./AXMBGY3/mbwj/plugins/morris-js/morris.min.js"></script>
<script src="./AXMBGY3/mbwj/plugins/raphael/raphael.min.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/pages/dashboard-demo.js"></script>
<script src="./AXMBGY3/mbwj/vertical/assets/js/theme.js"></script>
</body>

</html>