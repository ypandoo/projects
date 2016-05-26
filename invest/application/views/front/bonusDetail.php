<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>分红明细</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/bonusDetail.css')?>">


<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>

</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 分红明细</div>
	<div id="searchLayer">
		<!--div class="searSTY">
			分红日期：<input id="sDateInp" readonly />&nbsp;&nbsp;至&nbsp;&nbsp;<input id="eDateInp" readonly />
		</div>
		<div class="searSTY floatR">
			<input id="searTextInp" type="search" placeholder="请输入项目名" value="" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div-->
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="50" height="30">序号</td>
			<td width="240">跟投项目</td>
			<!--td width="110">认购类型</td-->
			<!-- <td width="120">认购包名</td> -->
			<!--td width="100">平衡额度<br>(不含杠杆)(万元)</td-->
			<td width="80">分红批次</td>
			<td width="130">分红日期</td>
			<td width="100">分红金额<br>(万元)</td>
			<td width="150">分红帐号</td>
			<!--td>备注</td-->
		</tr></thead>
		<tbody id="compTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td>合肥高新项目</td>
			<td>城市强投包</td>
			<td>20</td>
			<td>2</td>
			<td>2014-07-29</td>
			<td>12</td>
			<td>62266666666666</td>
			<td></td></tr> -->
		</tbody></table>
	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "2";
var dataList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	dataList = [];
}

function initListeners(){
	initHeaderListeners();

	$("#sDateInp").datetimepicker({format:"Y-m-d",timepicker:false});
	$("#eDateInp").datetimepicker({format:"Y-m-d",timepicker:false});
}

function initPages(){
	getData();
}

function getData(){
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();
	var _projectId = $("#searTextInp").val();
	var ctx= "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选getBonusRecord/getUserBonusRecord
		url:ctx+'BonusRecord/getBonusDetail',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			/*"startPage":0,
			"endPage":20,
			"startDate":_sDate,
			"endDate":_eDate,
			"projectName":_searText,
			"projectId":"",*/
			uid:"1"
		},
		success:function(msg){
			if(msg.success){
				dataList = msg.data;
				loadData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	alert(errorThrown); 
        }
	})
}

function loadData(){
	$("#compTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td height="35">'+(ind+1)+'</td>'+
				'<td><a href="<?php echo site_url();?>back/index/projectDetail?projectId='+val.FID+'">'+val.FNAME+'</a></td>'+
				//'<td>'+val.subscribeType+'</td>'+
				//'<td>'+(val.subscribeAmount)+'</td>'+
				'<td>'+val.FBONUSTIMES+'</td>'+
				'<td>'+(new Date(val.FBONUSDATE)).format('yyyy-MM-dd')+'</td>'+
				'<td>'+(val.FBONUSAMOUNT)+'</td>'+
				//'<td>'+(val.subscribePackageName||"")+'</td>'+
				'<td>'+(val.FBANKNO||"")+'</td></tr>';
		});
		$("#compTbody").html(tempHtml);
	}
}

function callDialog(){
	$("#dialogBg").show();
	$("#dialogLayer").show();
}

function hideDialog(){
	$("#dialogBg").hide();
	$("#dialogLayer").hide();

}
</script>
</body>
</html>