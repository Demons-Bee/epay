<?php
include("../includes/common.php");
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title = '投诉处理';
include './head.php';
?>
<?php

$type_select = '<option value="0">所有支付方式</option>';
$rs = $DB->getAll("SELECT * FROM pre_type WHERE status=1 ORDER BY id ASC");
foreach ($rs as $row) {
  $type_select .= '<option value="' . $row['id'] . '">' . $row['showname'] . '</option>';
}
unset($rs);

?>
<style>
  .dates {
    max-width: 120px;
  }

  .fixed-table-toolbar,
  .fixed-table-pagination {
    padding: 15px;
  }
</style>
<link href="../assets/css/datepicker.css" rel="stylesheet">
<div id="content" class="app-content" role="main">
  <div class="app-content-body ">

    <div class="bg-light lter b-b wrapper-md hidden-print">
      <h1 class="m-n font-thin h3">投诉处理</h1>
    </div>
    <div class="wrapper-md control">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-info">
          <?php echo $msg ?>
        </div>
      <?php } ?>
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          <h3 class="panel-title">投诉处理<a href="javascript:searchClear()" class="btn btn-default btn-xs pull-right" title="刷新投诉列表"><i class="fa fa-refresh"></i></a></h3>
        </div>

        <form onsubmit="return searchSubmit()" method="GET" class="form-inline" id="searchToolbar">
          <input type="hidden" class="form-control" name="gid">
          <input type="hidden" class="form-control" name="upid">
          <div class="form-group">
            <label>搜索</label>
            <select name="column" class="form-control">
              <option value="orderid">订单号</option>
              <option value="qq">QQ</option>
              <option value="phone">手机号码</option>
              <option value="status">回复状态</option>
            </select>
          </div>
          <div class="form-group" id="Souquery">
            <input type="text" class="form-control" name="value" placeholder="搜索内容">
          </div>
          <button type="submit" class="btn btn-primary">搜索</button>
          <a href="javascript:searchClear()" class="btn btn-default" title="刷新投诉列表"><i class="fa fa-refresh"></i></a>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">批量操作 <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="javascript:replyAll()">批量回复</a>
            </ul>
          </div>
        </form>
        <table id="listTable">
        </table>
      </div>
    </div>
  </div>
</div>
<a style="display: none;" href="" id="vurl" rel="noreferrer" target="_blank"></a>
<?php include 'foot.php'; ?>
<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.min.js"></script>
<script src="<?php echo $cdnpublic ?>bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $cdnpublic ?>bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<script src="<?php echo $cdnpublic ?>bootstrap-table/1.20.2/bootstrap-table.min.js"></script>
<script src="<?php echo $cdnpublic ?>bootstrap-table/1.20.2/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>
<script src="../assets/js/custom.js"></script>
<script>
  $('#listTable').bootstrapTable({
    method: 'post',
    url: 'ajax_complaint.php?act=ComplaintList',
    columns: [{
        field: '',
        checkbox: true
      },
      {
        field: 'id',
        title: 'ID',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'orderid',
        title: '订单号',
      },
      {
        field: 'qq',
        title: 'QQ',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'phone',
        title: '手机号码',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'addtime',
        title: '投诉时间',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'content',
        title: '投诉内容',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'reply',
        title: '回复内容',
        align: 'center',
        valign: 'middle'
      },
      {
        field: 'status',
        title: '状态',
        align: 'center',
        valign: 'middle',
        formatter: function(value, row, index) {
          if (value == 2) {
            return '<span class="label label-danger">未处理</span>';
          } else if (value == 1) {
            return '<span class="label label-success">已处理</span>';
          }
        }
      },
      {
        field: 'id',
        title: '操作',
        align: 'center',
        valign: 'middle',
        formatter: function(value, row, index) {
          return '<a href="javascript:reply(\'' + row.id + '\')" class="btn btn-xs btn-primary" style="margin:2px">回复</a>';
        }
      }
    ],
    queryParams: function(params) {
      return {
        type: $("select[name='column']").val(),
        value: $("input[name='value']").val(),
      };
    },
    responseHandler: function(res) {
      return {
        total: res.total,
        rows: res.data
      };
    },
  })

  function searchSubmit() {
    var column = $('select[name="column"]').val();
    var value = $('input[name="value"]').val();
    if (column == 'orderid' && !/^\d+$/.test(value)) {
      console.log(column);
      layer.alert('订单号只能为纯数字', {
        icon: 2
      });
      return false;
    }
    if (column == 'qq' && !/^\d+$/.test(value)) {
      layer.alert('QQ只能为纯数字', {
        icon: 2
      });
      return false;
    }
    if (column == 'phone' && !/^\d+$/.test(value)) {
      layer.alert('手机号只能为纯数字', {
        icon: 2
      });
      return false;
    }
    if (column == 'status' && !/^\d+$/.test(value)) {
      layer.alert(`状态只能为1和2<br><span style="color: green">1为已处理</span><br><span style="color: blue">2为未处理</span>`, {
        icon: 2
      });
      return false;
    }
    $('#listTable').bootstrapTable('refresh');
    return false;
  }

  function searchClear() {
    window.location.reload();
  }

  function reply(id) {
    layer.prompt({
      title: '请输入回复内容',
      formType: 2
    }, async function(text, index) {
      layer.close(index);
      const {
        data
      } = await $.post('ajax_complaint.php?act=reply', {
        id: id,
        reply: text
      }, function(res) {
        if (res.code == 1) {
          layer.alert(res.msg, {
            icon: 1
          }, function() {
            window.location.reload();
          });
        } else {
          layer.alert(res.msg, {
            icon: 2
          });
        }
      })
    });
  }

  function replyAll() {
    var ids = $.map($('#listTable').bootstrapTable('getSelections'), function(row) {
      return row.id;
    });
    if (ids.length == 0) {
      layer.alert('请先选择要回复的投诉', {
        icon: 2
      });
      return false;
    }
    layer.prompt({
      title: '请输入回复内容',
      formType: 2
    }, async function(text, index) {
      layer.close(index);
      layer.msg('正在回复', {
        icon: 16,
        shade: 0.01
      });
      const {
        data
      } = await $.post('ajax_complaint.php?act=replyAll', {
        ids: ids,
        reply: text
      }, function(res) {
        if (res.code == 1) {
          layer.alert(res.msg, {
            icon: 1
          }, function() {
            window.location.reload();
          });
        } else {
          layer.alert(res.msg, {
            icon: 2
          });
        }
      })
    });
  }
</script>