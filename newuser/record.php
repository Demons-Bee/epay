<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='资金明细';
include './head.php';
?>
<style>
.fixed-table-toolbar,.fixed-table-pagination{padding: 15px;}
</style>
<div id="layout-wrapper">
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">资金明细</h4>
                  <p class="card-subtitle mb-4">在此处查看您的资金明细</p>
                  <!---->
                   <div id="content" class="app-content" role="main">
    <div class="app-content-body ">


<div class="wrapper-md control">
<?php if(isset($msg)){?>
<div class="alert alert-info">
	<?php echo $msg?>
</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			<h3 class="panel-title">资金明细<a href="javascript:searchClear()" class="btn btn-default btn-xs pull-right" title="刷新明细列表"><i class="fa fa-refresh"></i></a></h3>
		</div>
	    <form onsubmit="return searchSubmit()" method="GET" class="form-inline" id="searchToolbar">
	      <div class="form-group">
			<select class="form-control" name="type">
			  <option value="1">操作类型</option>
			  <option value="2">变更金额</option>
			  <option value="3">关联订单号</option>
			</select>
		  </div>
		  <div class="form-group" id="searchword">
			<input type="text" class="form-control" name="kw" placeholder="搜索内容" style="min-width: 300px;">
		  </div>
		  <div class="form-group">
			<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> 搜索</button>
		  </div>
		</form>
      <table id="listTable">
	  </table>
	</div>
</div>
    </div>
  </div>
                  <!---->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="menu-overlay"></div>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.min.js"></script>
<script src="<?php echo $cdnpublic?>bootstrap-table/1.20.2/bootstrap-table.min.js"></script>
<script src="<?php echo $cdnpublic?>bootstrap-table/1.20.2/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>
<script src="../assets/js/custom.js"></script>
<script>
$(document).ready(function(){
	updateToolbar();
	const defaultPageSize = 30;
	const pageNumber = typeof window.$_GET['pageNumber'] != 'undefined' ? parseInt(window.$_GET['pageNumber']) : 1;
	const pageSize = typeof window.$_GET['pageSize'] != 'undefined' ? parseInt(window.$_GET['pageSize']) : defaultPageSize;

	$("#listTable").bootstrapTable({
		url: 'ajax2.php?act=recordList',
		pageNumber: pageNumber,
		pageSize: pageSize,
		classes: 'table table-striped table-hover table-bordered',
		columns: [
			{
				field: 'type',
				title: '操作类型',
				formatter: function(value, row, index) {
					return row.action==2?'<font color="red">'+value+'</font>':'<font color="green">'+value+'</font>';
				}
			},
			{
				field: 'money',
				title: '变更金额',
				formatter: function(value, row, index) {
					return (row.action==2?'- ':'+ ')+value;
				}
			},
			{
				field: 'oldmoney',
				title: '变更前金额'
			},
			{
				field: 'newmoney',
				title: '变更后金额'
			},
			{
				field: 'date',
				title: '时间'
			},
			{
				field: 'trade_no',
				title: '关联订单号',
				formatter: function(value, row, index) {
					return value?'<a href="./order.php?type=1&kw='+value+'">'+value+'</a>':'无';
				}
			},
		],
	})
})
</script>