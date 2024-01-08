<?php
include("../includes/common.php");
if($islogin2==1){}else exit('{"code":-3,"msg":"No Login"}');
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;

if (!checkRefererHost()) exit('{"code":403}');
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
  case 'ComplaintList':
    $sql = '';
    if (!empty($_POST['type']) && !empty($_POST['value'])) {
      $sql = 'where ' . $_POST['type'] . '=' . daddslashes($_POST['value']);
    }
    if (empty($sql)) {
      $sql = 'where uid=' . $uid;
    }
    $sql = 'select * from pre_workorder ' . $sql . ' order by id desc';
    $rs = $DB->query($sql);
    $res = [];
    while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    };
    $total = count($res);
    //分页
    $page = isset($_POST['offset']) ? intval($_POST['offset']) : 1;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
    $offset = ($page - 1) * $limit;
    $res = array_slice($res, $offset, $limit);
    exit(json_encode(['code' => 0, 'msg' => 'ok', 'total' => $total, 'data' => $res]));
    break;

  case 'reply':
    $id = daddslashes($_POST['id']);
    $reply = daddslashes($_POST['reply']);
    $sql = "UPDATE pre_workorder SET status=1,reply='{$reply}' WHERE id='{$id}'";
    //执行
    if ($DB->query($sql)) {
      exit(json_encode(['code' => 1, 'msg' => '回复成功!']));
    } else {
      exit(json_encode(['code' => -1, 'msg' => '回复失败!']) . $DB->error());
    }
    break;
  case 'replyAll':
    $ids = (array) daddslashes($_POST['ids']);
    $ids = array_map('intval', $ids);
    $ids = implode(',', $ids);
    $reply = daddslashes($_POST['reply']);
    $sql = "SELECT id FROM pre_workorder WHERE id in ({$ids}) and status=2";
    $rs = $DB->query($sql);
    $res = [];
    while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    };
    $res = array_column($res, 'id');
    $res = implode(',', $res);
    if (!empty($res)) {
      $sql = "UPDATE pre_workorder SET status=1,reply='{$reply}' WHERE id in ({$res})";
    } else {
      exit(json_encode(['code' => -1, 'msg' => '操作失败,没有可回复的订单!']));
    }

    if ($DB->query($sql)) {
      exit(json_encode(['code' => 1, 'msg' => '操作成功!']));
    } else {
      exit(json_encode(['code' => -1, 'msg' => '操作失败!']));
    }
}
