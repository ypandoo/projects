<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>缴款确认</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/payInDetail.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
</head>

<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url();?>">首页</a> > 缴款确认</div>
	<div id="searchLayer">
		<!--div class="searSTY dimissionSTY displayNone">
			<button id="dimissionBtn">离职退款</button>
		</div>
		<!--div class="searSTY floatR">
			<input id="searTextInp" type="search" placeholder="请输入项目名查询" value="" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div-->
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="80" height="30">序号</td>
			<td width="240">跟投项目</td>
			<!--td width="130">区域/总部</td-->
			<td width="150">平衡额度<br>(不含杠杆)(万元)</td>
			<td width="120">缴款批次</td>
			<td width="170">缴款日期</td>
			<td>缴款金额<br>(万元)</td>
		</tr></thead>
		<tbody id="payInTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td>合肥高新项目</td>
			<td>城市强投包</td>
			<td>20</td>
			<td>2</td>
			<td>2014-07-29</td>
			<td>50</td></tr> -->
		</tbody></table>
	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	var dataList = [];
var uid = "<?php echo $uid ?>";
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
	$("#searchBtn").click(getData);
	$("#dimissionBtn").click(setDimission);
}

function initPages(){
	getData();
}

function getData(){
	var _searText = $("#searTextInp").val();
	var ctx="<?php echo site_url();?>";
	var _obj = {uid:uid};
	$.ajax({
		type:'post',//可选get
		url:ctx+'Payrecord/getPayInDetail',
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				dataList = msg.data;
				loadData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadData(){
	$("#payInTbody").empty();
	if(dataList && dataList.length > 0){
		if($(".dimissionSTY").hasClass("displayNone")) $(".dimissionSTY").removeClass("displayNone");

		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td width="50" height="35">'+(ind+1)+'</td>'+
			'<td>'+(val.FNAME||"")+'</td>'+
			//'<td>'+(val.subType)+'</td>'+
			'<td>'+(val.FCONFIRMAMOUNT||0)+'</td>'+
			'<td>'+val.FPAYTIMES+'</td>'+
			'<td>'+(new Date(val.FPAYTIMES)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+(val.FPAYAMOUNT)+'</td></tr>';

				// tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
				// '<td>'+val.uname+'</td>'+
				// '<td>'+(val.service||"")+'</td>'+
				// '<td>'+val.subType+'</td>'+
				// '<td>'+formatMillions(val.subscribeAmt)+'</td>'+
				// '<td>'+val.piTimes+'</td>'+
				// '<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
				// '<td>'+formatMillions(val.piAmt)+'</td>'+
				// '<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#payInTbody").html(tempHtml);
	}
}

function setDimission(){
	/*$.ajax({
		type:'post',//可选get
		url:'../subscribe/updateDimissionByUid.action',
		// contentType: "application/json; charset=utf-8",
		// dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"uid": $("#loginInp").val(),
			"isDimission": "1"
		},
		success:function(msg){
			if(msg.success){
				alert("离职申请成功! 请等待管理员进行退款处理。")
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})*/
}
</script>
</body>
</html>