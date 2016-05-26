<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 缴款确认列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/plugins/pagination.css')?>">
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.pagination.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ajaxfileupload.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<style type="text/css">
body{font-size: 12px;}
#rightLayer #searchLayer{text-align: right;margin:0px auto 10px;position: relative;}
#rightLayer #searchLayer .btnSTY{float: left;margin: 10px 5px 0px;}
#rightLayer #searchLayer input{width: 200px;height: 25px;padding:0px 5px;}
#rightLayer #searchLayer .dateSTY{width: 100px;}

#rightLayer #payInTable{border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;}
#rightLayer #payInTable thead{background: url(images/thead_bg.png);}
#rightLayer #payInTable td{text-align: center;border: 1px solid #e8e8e8;}
#rightLayer #payInTable input{width: 60px;height: 25px;}
</style>
<script type="text/javascript">
var payInList = null;
$(function(){
	initPayInParams();
	initPayInListeners();
	initPayInPages();
});
function initPayInParams(){
	// PayInDetailController
	payInList = [];
}
function initPayInListeners(){
	$("#searTextBtn").click(getPayInList);
	$("#sDateInp").datetimepicker({format:'Y-m-d',timepicker:false});
	$("#eDateInp").datetimepicker({format:'Y-m-d',timepicker:false});
	
	// 导出缴款模板
	$("#rightLayer #exportSubBtn").click(function(){
		//location.href = "../subscribe/callSubscribeRecordByPI.action?projectId="+projectId;
		ctx = "<?php echo site_url();?>";
		$.ajax({
				type:'post',//可选get
				url:ctx+'Payrecord/outputXls',
				// contentType:"application/json",
				dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
				data:{
					projectId:getReqParam('ProjectId')
					},
				success:function(msg){
					if(msg.success){
						//alert("删除成功！");
						//getConfirmData();
						location.href=ctx+'fileFolder/'+msg.data;
					}else{
						alert(msg.error);
					}
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
		        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		        }
			})
	});
	// 导入缴款数据
	$("#rightLayer #importBtn").click(function(){
		$("#file").click();
	});
	// 导出缴款数据
	$("#rightLayer #exportBonusBtn").click(function(){
		//location.href = "../PayInDetailController/callPayInExport.action?projectId="+projectId+"&piIds=";
		var _sDate = $("#sDateInp").val();
		var _eDate = $("#eDateInp").val();
		var _searText = $("#searTextInp").val();
		var ctx = "<?php echo site_url();?>";
		var _obj = {projectId: getReqParam("projectId"),
					startDate:_sDate,
					endDate:_eDate,
					uname:_searText,
					startPage:0,
					endPage:999
		};
		$.ajax({
			type:'post',
			url: ctx+'/Payrecord/exportPayRecordXls', //用于文件上传的服务器端请求地址
			dataType: 'JSON', //返回值类型 一般设置为json
			data:_obj,
			success: function (msg){  //服务器成功响应处理函数			
				if(msg.success == true){
					//alert("导入成功!");
					//getPayInList();
					//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
					location.href=ctx+'fileFolder/'+msg.data;
				}else{
					alert("1:"+msg.error);
				}
			},
			error: function (data, status, e){//服务器响应失败处理函数		
				alert("2:"+e);
			}
		})
	});
	// 删除单条数据
	$("#payInTbody .delBtn").live("click", delPayInFunc);

	$("#file").live("change", importPIFunc); 
}
function initPayInPages() {
	getPayInList();
}
function getPayInList(){
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();
	var _obj = {projectId: getReqParam("projectId"),
			// '"projectName":"'+_searText+'",'+
			startDate:_sDate,
			endDate:_eDate,
			// '"piId":"",'+
			// '"piTimes":0,'+
			// '"subscribeAmt":0,'+
			// '"piDate":"",'+
			// '"piAmt":0,'+
			// '"numberCode":"",'+
			uname:_searText,
			// '"userId":""'+
			startPage:0,
			endPage:999
			};
	ctx = "<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Payrecord/getPayRecordListByName',
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				payInList = msg.data;
				loadPayInList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadPayInList(){
	$("#payInTbody").empty();
	/*
	FCONFIRMAMOUNT: "1"
	FID: "14"
	FNAME: "123"
	FORG: "test"
	FPAYAMOUNT: "212"
	FPAYDATE: "2016-01-23"
	FPAYTIMES: "1"
	FSTATE: "区域"*/
	if(payInList){
		var tempHtml = "";
		$.each(payInList, function(ind,val){
			tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
				'<td>'+val.FNAME+'</td>'+
				'<td>'+val.FSTATE+'</td>'+
				'<td>'+(val.FCONFIRMAMOUNT)+'</td>'+
				'<td>'+val.FPAYTIMES+'</td>'+
				'<td>'+(new Date(val.FPAYDATE)).format('yyyy-MM-dd')+'</td>'+
				'<td>'+(val.FPAYAMOUNT)+'</td>'+
				'<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#payInTbody").html(tempHtml);
	}
}

function importPIFunc(){
	if($("#file").val() == ""){
		return false;
	}
	var ctx = "<?php echo site_url();?>";
	$.ajaxFileUpload({
		url: ctx+'/Payrecord/inputXLS', //用于文件上传的服务器端请求地址
		secureuri: false, //是否需要安全协议，一般设置为false
		fileElementId: 'file', //文件上传域的ID
		dataType: 'JSON', //返回值类型 一般设置为json
		data:{
			// "filePath":"d://BonusDetail.xlsx"
		},
		success: function (data, status){  //服务器成功响应处理函数			
			if(status == "success"){
				alert("导入缴款成功!");
				getPayInList();
				//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
			}else{
				alert("1:"+data.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert("2:"+e);
		}
	})
}

function delPayInFunc(){
	var _ind = $(this).attr("ind");
	var _dataObj = payInList[_ind];

	$.ajax({
		type:'post',//可选get
		url:ctx+'/Payrecord/deletePayrecord',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"FID": _dataObj.FID
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				getPayInList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
</script>
</head>
<body id="rightLayer">
<div id="searchLayer">
	<input type="file" id="file" name="file" class="displayNone">
	<button id="exportSubBtn" class="btnSTY">导出缴款模板</button>
	<button id="importBtn" class="btnSTY">导入缴款</button>
	<button id="exportBonusBtn" class="btnSTY">导出缴款</button>
	缴款日期：<input id="sDateInp" readonly class="dateSTY" />至<input id="eDateInp" readonly class="dateSTY" style="margin-right: 40px;" />
	<input id="searTextInp" placeholder="请输入认购人查询" type="search"/><button id="searTextBtn">搜索</button>
</div>
<table id="payInTable" border="1" width="100%"><thead><tr>
	<td height="34" width="40">序号</td>
	<td width="110">跟投人</td>
	<td width="100">区域/总部</td>
	<td width="120">认购金额<br></td>
	<td width="120">缴款批次</td>
	<td width="150">缴款日期</td>
	<td>缴款金额(万元)</td>
	<td>操作</td>
</tr></thead>
<tbody id="payInTbody">
	<!-- <tr><td height="35">1</td>
		<td>张三</td>
		<td>合肥高新项目</td>
		<td>55</td>
		<td>2</td>
		<td>2014-09-01</td>
		<td>5.5</td>
		<td><a href="javascript:void(0)">删除</a></td></tr> -->
</tbody></table>
</body>
</html>