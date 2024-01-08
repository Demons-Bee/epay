<?php
include("../includes/common.php");

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

switch($act){

case 'wximg':
	if(!checkRefererHost())exit();
	$channelid = intval($_GET['channel']);
	$media_id = $_GET['mediaid'];
	$channel=\lib\Channel::get($channelid);
	$wechatpay_config = require(PLUGIN_ROOT.$channel['plugin'].'/inc/config.php');
	try{
		$client = new \WeChatPay\V3\ComplainService($wechatpay_config);
		$image = $client->getImage($media_id);

		$seconds_to_cache = 3600*24*7;
		header("Cache-Control: max-age=$seconds_to_cache");
		header("Content-Type: image/jpeg");
		echo $image;
	}catch (Exception $e) {
		echo $e->getMessage();
	}
break;

default:
	exit('No Act');
break;
}