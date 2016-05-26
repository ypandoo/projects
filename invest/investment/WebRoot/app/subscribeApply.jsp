<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
	String loginId = (String)request.getSession().getAttribute("loginId");
	String loginName = (String)request.getSession().getAttribute("loginName");
	String accountName = (String)request.getSession().getAttribute("accountName");
%>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<title>认购申请</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script> -->
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquerymobile/1.4.2/jquery.mobile.min.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<style type="text/css">
#bonusIdInp{font-weight: 100;}
#subscribeDialog .selectSTY{font-weight: 100;margin-left: -1.5em;font-size: .8em;}
#protocalInp{height: 80px;overflow-y: scroll;width: 100%;border: 1px solid lightgray;resize:none;}
#dialogHeader, #protocalListHeader,#protocalContentHeader{height: 40px;line-height: 40px;text-align: center;}
table{border-collapse: collapse;border:0px solid #e8e8e8;}
table td{text-align: right;font-size: .8em;padding: 5px 10px;}
table td div{display: inline-block;}
table .titleTd{background: #F4F9FF; width:65px;height: 30px;}
.inpSTY{text-align: right;border-radius: 3px;padding-right: 5px;}
.readonly{background: #ECECEC;border: 1px solid #C0C0C0;}
#toBankBtn{background: #FFF;font-size: .8em;font-weight: 100;padding: .7em 3em .7em 1em;width: auto;float: right;box-shadow: none;margin: 0;}

textarea.ui-input-text{min-height:200px;}
.ui-mobile label, div.ui-controlgroup-label{font-size: .8em;}
.ui-checkbox, .ui-radio{margin: .5em auto;width: 130px;}
.ui-select{margin:0;display:block;}
.ui-btn{padding: .5em 1em;}
.ui-body-a, .ui-page-theme-a .ui-body-inherit, html .ui-bar-a .ui-body-inherit, html .ui-body-a .ui-body-inherit, html body .ui-group-theme-a .ui-body-inherit, html .ui-panel-page-container-a{width: 30%;}
.ui-page-theme-a .ui-btn.ui-btn-active,
html .ui-bar-a .ui-btn.ui-btn-active,
html .ui-body-a .ui-btn.ui-btn-active,
html body .ui-group-theme-a .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-a.ui-btn-active{border-color: lightgray;/*color: #D94026;background: #FFF;*/text-shadow:none;color: #000;}

.ui-listview > li {
	display: block;
	position: relative;
	overflow: visible;
	margin: 1em;
}

#agreeBtn{
	display: inline;
}

#protocalBtn{
	display: inline;
}

#remissionCountTr{
	display: none;
}

#submitBtn,#remissionSumbitBtn{
	display: inline-block;
	width: 5em;
}
#remissionSumbitBtn{
	cursor: pointer;
	display: none;
}
</style>
<script type="text/javascript">
var currAccountName = "admin";
var currUser = '1001';
var proId = "-1";
var forceList = null;
var currProDetail = null;
var currscheDetail = null;
var forceObj = null;
var bankList = null;
var topLimitVal = 0;
var downLimitVal = 0;
$(function(){
	proId = getReqParam("proId");
	currAccountName = $("#accountNameInp").val();
	currUser = $("#loginInp").val();

	//clearHash();
	initListeners();

	getProDetai();
	getProScheme();
});
function initListeners(){
	$("#agreeBtn").click(function(){
		// alert()
		getBankData();
	});
	$("#submitBtn").click(function(){
		submitFunc(false);
	});
	$("#remissionSumbitBtn").click(function(){
		submitFunc(true);
	});
	$("#subMoneyInp").blur(function(){
		if(isForcePerson()){
			if($("#leverSel").val() == "4"){
				$("#levMoneyInp").val($(this).val()*4);
			}else{
				$("#levMoneyInp").val("0");
			}
		}
	});
	$("#leverSel").change(function(){
		if($(this).val() == "0"){
			$("#levMoneyInp").val("0");
			topLimitVal = topLimitVal*5;
			downLimitVal = downLimitVal*5;
		}else{
			$("#levMoneyInp").val($("#subMoneyInp").val()*4);
			topLimitVal = topLimitVal/5;
			downLimitVal = downLimitVal/5;
		}
		$("#upLimitInp").text(formatMillions(topLimitVal));
		$("#downLimitInp").text(formatMillions(downLimitVal));
	});

	$("#protocalBtn").click(function(){
		fetchProtocalList();
	});
}

function fetchProtocalList(){
	$.ajax({
		type:'post',//可选get
		url:'../ProjectBasicController/subscribeProtocalList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{'projectId':proId},
		success:function(msg){
			if(msg.success){
				if(msg.dataDto){
					$("#protocalListContent > li").remove();
					showProtocalList(msg.dataDto);
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function showProtocalList(protocalList){
	var result = "";
	for (var i = 0; i < protocalList.length; i++) {
		//result = result + "<li><a href='#protocalContentDialog' data-rel='dialog' fileName='" + protocalList[i] + "' onClick='showProtocalContent(this)' file='" + protocalList[i] + "'>" + (i + 1 + " 、") + protocalList[i] + "</a></li>";

		result = result + "<li><a data-ajax='false' href='../front/files/" + protocalList[i] + "' fileName='" + protocalList[i] + "' onClick='showProtocalContent(this)'>" + (i + 1 + " 、") + protocalList[i] + "</a></li>";
	};
	$("#protocalListContent").append(result);
}

function showProtocalContent(source){
	//var fileName = $(source).attr("fileName");
	//fetch
}

function clearHash(){
	var _hash = location.hash;
	// $('.ui-dialog').dialog('close');
	if(_hash){
		$('.ui-dialog').dialog('close');
		// location.hash = "";
		history.go(-1);
	}
}
function getProDetai(){
	$.ajax({
		type:'post',//可选get
		url:'..//ProjectBasicController/getProjectById.action',
		cache:false,
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId},
		success:function(msg){
			if(msg.success){
				if(msg.baseModel){
					currProDetail = msg.baseModel;
					$("#proNameInp").text(currProDetail.projectName);
					$("#dialogHeader").text(currProDetail.projectName);
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}
function getProScheme(){
	$.ajax({
		type:'post',//可选get
		url:'..//FollowSchemeController/getSchemeByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId},
		cache:false,
		success:function(msg){
			getForceData();
			if(msg.success){
				if(msg.baseModel){
					currscheDetail = msg.baseModel;
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	});
}
function getForceData(){
	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId,'forceType':''},
		cache:false,
		success:function(msg){
			if(msg.success){
				forceList = msg.dataDto;
				loadLimitData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getForceData(){
	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId,'forceType':''},
		cache:false,
		success:function(msg){
			if(msg.success){
				forceList = msg.dataDto;
				loadLimitData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadLimitData(){
	if(isForcePerson()){
		topLimitVal = parseInt(forceObj.toplimit);
		downLimitVal = parseInt(forceObj.downlimit);
		$("#leverSelRow").show();
		$("#leverageRow").show();
	}else{
		topLimitVal = (currscheDetail.maxamount);
		downLimitVal = (currscheDetail.minamount);
		$("#leverSelRow").hide();
		$("#leverageRow").hide();
	}
	$("#upLimitInp").text(formatMillions(topLimitVal));
	$("#downLimitInp").text(formatMillions(downLimitVal));
}

function getBankData(argument) {
	$.ajax({
		type:'post',//可选get
		url:'../BankController/getBankListByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		cache:false,
		success:function(msg){
			if(msg.success){
				bankList = msg.dataDto;
				loadBankData();
				userInfo = msg.baseModel;
				loadRemissionInfo(msg.baseModel);
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadRemissionInfo(userInfo){
	if((userInfo.remissionCount - userInfo.usedRemissionCount) > 0){
		$("#remissionCountTr").css("display", "table-row");
		$("#remissionCountTr #remissionCount").val(userInfo.remissionCount - userInfo.usedRemissionCount);
		$("#remissionSumbitBtn").css("display","inline-block");
	}
}

function loadBankData(){
	$("#bonusIdInp").empty();
	var tempHtml = "";
	if(bankList && bankList.length >0){
		$("#bonusIdInp").empty();
		$.each(bankList, function(ind, val){
			tempHtml +=
				'<option value="'+val.bankId+'">'+val.bankNo+'</option>';
		});
		$("#bonusIdInp").html(tempHtml).selectmenu("refresh");;
	}else{
		tempHtml = '<option value=""></option>';
		$("#bonusIdInp").html(tempHtml).selectmenu("refresh");;
	}
}

function isForcePerson(){
	var bool = false;
	$.each(forceList, function(ind, val){
		if(val.remark == currAccountName){
			forceObj = val;
			bool = true;
		}
	});
	return bool;
}

function submitFunc (isRemissionSubscribe) {
	var _subMoney = parseInt($("#subMoneyInp").val())*10000;
	var _levMoney = parseInt($("#levMoneyInp").val())*10000;
	var _bonusId = $("#bonusIdInp").val();
	var _bankNo = $("#bonusIdInp").val();
	if(isRemissionSubscribe){
		if(!window.confirm("您的总的可用豁免次数为：" + (userInfo.remissionCount - userInfo.usedRemissionCount) +"，您确认使用吗？")){
			return false;
		}
	}else{
		if(isForcePerson()){
			if($("#leverSel").val() == "4"){
				if(_subMoney > topLimitVal){
					alert("总认购金额超过上限!");
					return false;
				}else if(_subMoney < downLimitVal){
					alert("总认购金额低于下限!");
					return false;
				}
			}else{
				if(_subMoney < downLimitVal){
					alert("总认购金额低于下限!");
					return false;
				}else if(_subMoney > topLimitVal){
					alert("总认购金额超过上限!");
					return false;
				}
			}
		}else{
			if(_subMoney > topLimitVal){
				alert("总认购金额超过上限!");
				return false;
			}else if(_subMoney < downLimitVal){
				alert("总认购金额低于下限!");
				return false;			
			}
		}
		if(!_bankNo){
			alert("请选择银行帐号!");
			return false;	
		}
		if(_subMoney%50000 != 0){
			alert("认购金额只能输入5万的倍数!");
			return false;
		}
	}
	$('.ui-dialog').dialog('close');
	// window.location.href=document.referrer;
	// return false;
	$.ajax({
		type:'get',
		url:'../subscribe/subscribeReq.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{
			"uid":currUser,
			"projectId":proId,//"024ec88b-188b-4ada-a807-1f79454eeea3",
			"contributiveAmount":_subMoney,
			"leverageAmount":(_levMoney||0),
			"bankNo":_bankNo,
			"isRemissionSubscribe":isRemissionSubscribe
		},
		success:function(msg){
			alert("认购成功！");
			// location.href = "personalCenter.jsp";
			history.go(-2);
			//location.reload();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	});
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<input id="accountNameInp" type="hidden" value="${accountName}">
<div data-role="page">
	<!-- <div data-role="header">
		<a href="" data-rel="back" data-role="button">返回</a>
	</div> -->
	<div data-role="content">
		<label for="protocalInp">认购协议：<span id="proNameInp"></span></label>
		<textarea id="protocalInp" name="protocalInp" readonly>协议内容请下载附件查看。</textarea>
		<!-- <input id="agreeCK" name="agreeCK" type="checkbox" data-inline="true" /><label for="agreeCK">同意协议内容</label> -->
		<div style="text-align:center;margin-top: 1em;">
			<a id="agreeBtn" href="#subscribeDialog" data-rel="dialog" data-role="button">同意协议内容</a>
			<a id="protocalBtn" href="#protocalListDialog" data-rel="dialog" data-role="button">查看协议内容</a>
		</div>
	</div>
</div>
<div data-role="page" id="subscribeDialog">
	<div data-role="header" id="dialogHeader">合肥高新项目</div>
	<div data-role="content">
		<table width="100%" border="0"><tr id="leverSelRow">
			<td class="titleTd">杠杆比例:</td>
			<td><select id="leverSel">
				<option value="4">4</option>
				<option value="0">0</option>
			</select></td>
		</tr><tr>
			<td class="titleTd">出资下限:</td>
			<td><span id="downLimitInp">0</span> 万元</td>
		</tr><tr>
			<td class="titleTd">出资上限:</td>
			<td><span id="upLimitInp">0</span> 万元</td>
		</tr><tr>
			<td class="titleTd">出资金额:</td>
			<td><input id="subMoneyInp" type="number" class="inpSTY" value="0" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />&nbsp;万元</td>
		</tr><tr id="leverageRow">
			<td class="titleTd">杠杆金额:</td>
			<td><input id="levMoneyInp" type="number" class="inpSTY readonly" value="0" readonly />&nbsp;万元</td>
		</tr>
		<tr>
			<td class="titleTd">分红账号:</td>
			<td><select id="bonusIdInp" class="selectSTY">
				<option value="6226 3654 1231 238"><!-- 6226 3654 1231 238 --></option>
			</select>
			</td>
		</tr>
		<tr id="remissionCountTr">
			<td class="titleTd">可用豁免次数:</td>
			<td>
				<input disabled="disabled" id="remissionCount" class="inpSTY readonly" />
			</td>
		</tr>
		<tr style="display:inline-grid;">
			<td></td>
			<td height="30" valign="top">
				<!-- <span style="font-size:0.9em;">请<a id="addBonusBtn" href="javascript:void(0)" style="font-size:0.9em;">点击这里</a>添加分红帐号</span> -->
				<a id="toBankBtn" href="bankList.jsp?flag=sub" data-role="button" data-iconpos="right" data-icon="plus" rel="external">新增银行帐号</a>
			</td>
		</tr>
		<tr>
			<td colspan="2"  style="text-align: center;">
				<a id="submitBtn" data-role="button">提交</a>
				<a id="remissionSumbitBtn" data-role="button">豁免认购</a>
			</td>
		</tr></table>
	</div>
</div>
<div data-role="page" id="protocalListDialog">
	<div data-role="header" id="protocalListHeader">项目协议列表</div>
	<div data-role="content">
		<ul data-role="listview" id="protocalListContent">
			
		</ul>
	</div>
</div>
<div data-role="page" id="protocalContentDialog">
	<div data-role="header" id="protocalContentHeader">项目协议内容</div>
	<div data-role="content" id="protocalContent">
	</div>
</div>
</body>
</html>