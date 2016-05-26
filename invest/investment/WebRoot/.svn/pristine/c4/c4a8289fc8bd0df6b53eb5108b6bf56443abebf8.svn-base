<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
	String loginId = (String)request.getSession().getAttribute("loginId");
	String loginName = (String)request.getSession().getAttribute("loginName");
%>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<title>个人银行帐号</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
#addLayer{margin: -1em 0em 1em;overflow: hidden;}
#addLayer a{font-weight: 100;font-size: .8em;}
#addLayer #backBtn{float: left;color: #F00;padding: .7em .8em 0.7em 3em;}
#addLayer #addBtn{float: right;padding: .7em 3em .7em 0.8em;}
#bankList table{width: 100%;font-size: .9em;}
#bankList td{text-align: center;width: 85px;white-space: normal;}
#bankList td span{width: 1.5em;height: 1.5em;line-height: 1.5em;font-size: 1.5em;color: #F00;background: #9D9C9C;opacity: 1.5;display: inline-block;border-radius: 4.5em;padding: 0;font-weight: 900;cursor: pointer;text-shadow:none;}

#bankList .borderR_STY{border-right: 1px solid lightgray;font-weight: 900;}
#bankList .weightB_STY{font-weight: 900;font-size: 1.1em;}
#bankList .pointD_STY{color: red;}
#bankList .ctx_STY{width: 17em;word-break: break-all;}
#bankList .opr_STY{width: 0;}

#dialogHeader{height: 40px;line-height: 40px;text-align: center;}
#editorDialog .titleTd{background: #F4F9FF; width:6em;height: 30px;text-align: center;}
#editorDialog .tipsTd{color: red;font-size: .8em;}

.ui-content{/*padding: 0em 1em 1em;*/}
.ui-listview > .ui-li-static{padding: .7em 0em;}
.ui-btn{padding: .7em 0em;font-weight: 100;}
.ui-listview > .ui-li-static, .ui-listview > .ui-li-divider, .ui-listview > li > a.ui-btn{font-weight: 100;font-size: .95em;}
</style>
<script type="text/javascript">
var dataList = [];
var operateFlag = "add";
var operateInd = 0;
var tempEditObj = null;
$(function(){
	$('body').fontFlex(14, 60, 40);

	var flag = getReqParam("flag");
	if(flag || flag=="sub"){
		$("#backBtn").show();
	}

	$('#bankList').on("click", ".editBtn", function(){
		operateInd = $(this).attr("ind");
		// $("#dialogHeader").text("编辑帐号");
		resetDialog();
		fillData();
		operateFlag = "update";

	});
	$('#bankList').on("click", "li .delBtn", function(e){
		e.stopPropagation();
		operateInd = $(this).attr("ind");
		delData();
		return false;
	});

	$("#addBtn").click(function(){
		resetDialog();
		operateFlag = "add";
		// $("#dialogHeader").text("添加帐号");
		operateInd = $(this).attr("ind");
	});

	$("#submitBtn").click(function(){
		if(operateFlag == "add"){
			addData();
		}else{
			updateData();
		}
	});

	getData();
});
function getData(){
	$.ajax({
		type:'post',//可选get
		url:'../BankController/getBankListByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"startPage":0,
			"endPage":999,
			"startDate":"",
			"endDate":"",
			"projectName":"",
			"projectId":"",
			"userid":"true"
		},
		success:function(msg){
			if(msg.success){
				dataList = msg.dataDto;
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
	// $("#bankList").empty();
	$("#bankList li:not(:first)").remove();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml = 
				'<li data-icon="false" ind="'+ind+'">'+
					'<a class="editBtn" href="#editorDialog" data-rel="dialog" ind="'+ind+'">'+
						'<table><tr><td class="ctx_STY">'+val.bankNo+'</td>'+
						'<td class="ctx_STY">'+val.bankAttribute+'</td>'+
						'<td class="ctx_STY">'+val.bankName+'</td>'+
						'<td class="opr_STY"><span class="delBtn" ind="'+ind+'">X</span></td>'+
						/*'<td class="opr_STY"></td>'+*/
						'</tr></table>'+
					'</a>'+
				'</li>';
			$("#bankList").append(tempHtml);
		});
		$('#bankList').listview("refresh");
	}
}
function delData(){
	tempEditObj = dataList[operateInd];
	$.ajax({
		type:'post',
		url:'../BankController/deleteBank.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"bankId": tempEditObj.bankId
		},
		success:function(msg){
			if(msg.success){
				alert("删除帐号成功!");
				getData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// alert(errorThrown); 
			getData();
		}
	})
}
function addData(){
	var bankNo = $.trim($("#bankNoInp").val());
	var bankName = $.trim($("#bankNameInp").val());
	var bankAttr = $.trim($("#bankAttrInp").val());

	if(bankNo.length <= 0){
		alert("银行卡号不能为空!");
	}else{
		$.ajax({
			type:'post',
			url:'../BankController/insertBank.action',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"bankNo": bankNo,
				"bankName": bankName,
				"bankAttribute": bankAttr
			},
			success:function(msg){
				if(msg.success){
					alert("添加帐号成功!");
					getData();
					$('.ui-dialog').dialog('close');
				}else{
					alert(msg.error);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
			}
		})
	}
}
function updateData(){
	var bankNo = $.trim($("#bankNoInp").val());
	var bankName = $.trim($("#bankNameInp").val());
	var bankAttr = $.trim($("#bankAttrInp").val());

	if(bankNo.length <= 0){
		alert("银行卡号不能为空!");
	}else{
		tempEditObj = dataList[operateInd];
		$.ajax({
			type:'post',
			url:'../BankController/updateBank.action',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"bankId": tempEditObj.bankId,
				"bankNo": bankNo,
				"bankName": bankName,
				"bankAttribute": bankAttr
			},
			success:function(msg){
				if(msg.success){
					alert("修改帐号成功!");
					getData();
					$('.ui-dialog').dialog('close');
				}else{
					alert(msg.error);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
			}
		})
	}
}
function fillData(){
	var _temp = dataList[operateInd];
	$("#bankNoInp").val(_temp.bankNo);
	$("#bankNameInp").val(_temp.bankName);
	$("#bankAttrInp").val(_temp.bankAttribute);
}
function resetDialog(){
	$("#bankNoInp").val("");
	$("#bankNameInp").val("");
	$("#bankAttrInp").val("");
	tempEditObj = null;
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="content">
		<div id="addLayer">
			<a id="backBtn" href="" data-role="button" data-iconpos="left" data-icon="back" data-rel="back" style="display:none">返回认购</a>
			<a id="addBtn" href="#editorDialog" data-role="button" data-iconpos="right" data-icon="plus" data-rel="dialog">新增帐号</a>
		</div>
		<!-- <ul data-role="listview" data-filter="true" data-filter-placeholder="请输入关键字查询">
			<li><table><tr class="weightB_STY">
				<td class="borderR_STY">分红项目</td>
				<td class="borderR_STY">分红日期</td>
				<td class="borderR_STY">分红批次</td>
				<td>分红金额</td>
			</tr></table></li>
		</ul> -->
		<ul id="bankList" data-role="listview" data-filter="false" data-filter-placeholder="请输入关键字查询">
			<li><table><tr class="weightB_STY">
				<td class="borderR_STY ctx_STY">卡号</td>
				<td class="borderR_STY ctx_STY">户名</td>
				<td class="borderR_STY ctx_STY">开户行</td>
				<td></td>
			</tr></table></li>
			<!-- <li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li>
			<li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li>
			<li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li> -->
		</ul>
	</div>
</div>
<div data-role="page" id="editorDialog">
	<div data-role="header" id="dialogHeader">编辑帐号</div>
	<div data-role="content">
		<table width="100%" border="0"><tr>
			<td colspan="2" class="tipsTd">*此帐号为最终财务汇款帐号，请务必准确填写;<br>建议使用工资卡，银行卡开户名需为认购本人选择帐号为反本/分红帐号</td>
		</tr><tr id="leverSelRow">
			<td class="titleTd">银行卡号:</td>
			<td><input id="bankNoInp" /></td>
		</tr><tr>
			<td class="titleTd">开户名:</td>
			<td><input id="bankAttrInp" /></td>
		</tr><tr>
			<td class="titleTd">开户银行:</td>
			<td><input id="bankNameInp" /><div class="tipsTd">请精确到支行,例如：中国建设银行(上海市怒江路支行)</div></td>
		</tr><tr>
			<td></td>
			<td class="tipsTd"></td>
		</tr><tr>
			<td></td>
			<td><a id="submitBtn" href="javascript:void(0)" data-role="button">提交</a></td>
		</tr></table>
	</div>
</div>
</body>
</html>