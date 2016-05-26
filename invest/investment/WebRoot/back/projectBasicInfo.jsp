<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- <link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css"> -->
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<style type="text/css">

.displayNone{display: none;}
.tip_STY{color: red;font-size: 1em;}
#rightLayer input[readonly='true']{background: #e8e8e8;border: 1px solid #BDBDBD;}
#rightLayer .editTitle{height: 30px;line-height: 30px;padding: 0px;/*background: #E0DBDB;border-bottom: 1px solid #949292;*/width: 15%;border-radius:4px 4px 2px 2px;margin:5px 0px 0px;cursor: pointer;font-weight: bold;}
#rightLayer .editTitle img{margin: 0px 10px;}
#rightLayer .editor{width:99%;min-height: 100px;margin: 0px auto;border: 1px solid #E0DBDB;overflow: hidden;padding: 5px;}
#rightLayer .editor .tdTitle{width: 13%;text-align: right;padding-right: 10px;font-size: 0.8em;}
#rightLayer .editor input{width: 45%;padding:0px 5px;margin: 3px 0px;}
#rightLayer .editor textarea{height:100px;width: 45%;resize:none;padding: 5px;margin: 3px 0px;}
#rightLayer .btnBox button{margin:10px 5px;}
#rightLayer #forceTable, #rightLayer #subTable{border-spacing: 1px; border-collapse: collapse;border:1px solid #C0BEBE;font-size: 0.9em;}
#rightLayer #forceTable .trTitle, #rightLayer #subTable .trTitle{background: url(images/thead_bg.png);color: #727070;}
#rightLayer #forceTable td, #rightLayer #subTable td{text-align: center;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody td, #rightLayer #subTable tbody td{height: 30px;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody input, #rightLayer #subTable tbody input{padding: 0px 3px;width: 70%;text-align: center;font-size: 1.1em;}

#forceDialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#forceDialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#forceDialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 750px;height: 360px;margin: 70px auto;}
#forceDialogLayer .dialogSTY .tipTitle{float:left;padding: 8px 15px;}
#forceDialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#forceDialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#forceDialogLayer .dialogSTY .contentDiv{width: 96%;height: 275px;margin: 3px auto;border: 0px solid #e8e8e8;overflow: hidden;}
#forceDialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#forceDialogLayer .dialogSTY .contentDiv table thead{background: url(images/thead_bg.png);}
#forceDialogLayer .dialogSTY .contentDiv table td{padding: 3px 5px;text-align: center;border: 1px solid #e8e8e8;}
#forceDialogLayer .dialogSTY .contentDiv table input{padding: 0px 3px;margin: 0px;width: 70px;text-align: center;}
#forceDialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#forceDialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#forceDialogLayer button{width: 50px;height: 25px;margin: 0px 5px;}
</style>
<script type="text/javascript">
var allUserList = [];
var forceObj = {};
var tempForceObj = {};
var tempAddForceObj = {};
var i=0;
var schemeLinkArr = [];
var protocalArr = [];
$(function(){
	$("#uploadProtocalForm .delProtocalLink").live("click", deleteSchemeProtocalFunc);
	$("#uploadForm .delSchemeLink").live("click", deleteSchemeLinkFunc);
	$("#rightLayer .editTitle").click(function(){
		var _editor = $("#"+$(this).attr("id")+"_editor");
		var isDis = _editor.hasClass("displayNone");
		if(isDis) _editor.removeClass("displayNone");
		else _editor.addClass("displayNone");
	})
	$("#addForceRecord").click(function(ev){
		callForceDialog();
	});
	$("#forceDialogLayer #allUserTbody input[name=userCk]").live("click",function(){
		var _cked = $(this).attr("checked");
		var _uid = $(this).attr("uid");
		var _ind = $(this).attr("ind");
		if(_cked){
			$(this).attr("checked","checked");
			if(!tempAddForceObj[_uid]){
				tempAddForceObj[_uid] = allUserList[_ind];
			}
		}else{
			$(this).removeAttr("checked");
			if(tempAddForceObj[_uid]){
				delete tempAddForceObj[_uid];
			}
		}
	});
	$("#forceDialogLayer #searUserBtn").click(getAllUserData);
	$("#forceDialogLayer #okBtn").click(addRows);
	$("#forceDialogLayer #cancelBtn").click(hideForceDialog);

	$("#addSubPackage").click(function(ev){
		var leng = $("#subTbody").children().length;
		var tempHtml = '<tr><td>'+(leng+1)+'</td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td></tr>';
		$("#subTbody").append(tempHtml);
	});
	$("#forceTbody .forceDelBtn").live("click",forceDelFunc);
	$("#groundInp").datetimepicker(/*{format:'Y-m-d',timepicker: false}*/);
	$("#stageStartInp").datetimepicker();
	$("#stageOpenInp").datetimepicker();
	// $("#peakInp").datetimepicker();
	// $("#cashflowReturnInp").datetimepicker();
	$("#deliverInp").datetimepicker();
	$("#carryoverInp").datetimepicker();
	$("#liquidateInp").datetimepicker();
	$("#subscribeStartInp").datetimepicker();
	$("#subscribeEndtInp").datetimepicker();
	$("#payStartInp").datetimepicker();
	$("#payEndInp").datetimepicker();
	$("#payReleaseDateInp").datetimepicker();
	var projectId=$("#projectid").val();
	if(projectId!="" && projectId!=null){
		//此id是做修改的时候 form表单的id 跟head.jsp里面的projectid 一样
		$("#newprojectId").val(projectId);
		$("#schemeProjectid").val(projectId);
		$("#forceProjectId").val(projectId);
		$("#subProjectId").val(projectId);
		$("#uploadProId").val(projectId);
		$("#uploadProId_1").val(projectId);
		getProjectDetail();
		getSchemeByProjectid();
		getForceFollowByProjectid();
		getSubscribeByProjectid();
	}
});
function getSubscribeByProjectid(){
	var ctx=$("#ctx").val();
	var projectId=$("#projectid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/subscribe/getSubscribeyProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				for(var m=0;m<msg.dataDto.length;m++){
					 $("#sub"+m+"subscribeId").val((msg.dataDto)[m].subscribeId);
					 $("#sub"+m+"followNature").val((msg.dataDto)[m].followNature);
					 $("#sub"+m+"followStaff").val((msg.dataDto)[m].followStaff);
					 $("#sub"+m+"amountToplimit").val((msg.dataDto)[m].amountToplimit);
					 $("#sub"+m+"contributiveSubscribe").val((msg.dataDto)[m].contributiveSubscribe);
					 $("#sub"+m+"leverageSubscribe").val((msg.dataDto)[m].leverageSubscribe);
					 $("#sub"+m+"subscribeAmountTotal").val((msg.dataDto)[m].subscribeAmountTotal);
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getForceFollowByProjectid(){
	var ctx=$("#ctx").val();
	var projectId=$("#projectid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'forceType':"1"
		},
		success:function(msg){
			if(msg.success){
				i=msg.dataDto.length;
				var _obj = null;
				var tempSel = "";
				for(var m=0;m<msg.dataDto.length;m++){
					_obj = (msg.dataDto)[m];
					forceObj[_obj.uid] = _obj;
					if(_obj.company == "集团强投包"){
						tempSel = '<select name="forceFollList['+m+'].company" ><option value="集团强投包" selected="selected">集团强投包</option><option value="城市强投包">城市强投包</option></select>';
					}else{
						tempSel = '<select name="forceFollList['+m+'].company" ><option value="集团强投包">集团强投包</option><option value="城市强投包" selected="selected">城市强投包</option></select>';
					}
					var tempHtml = 
					'<tr id="force_row_'+m+'">'+
						/*'<td>'+(m+1)+'</td>'+*/
						'<td><input type="hidden" name="forceFollList['+m+'].forceFollowId" value="'+_obj.forceFollowId+'" />'+
						'<input type="hidden" name="forceFollList['+m+'].forceType" value="'+_obj.forceType+'" />'+
						'<input type="hidden" name="forceFollList['+m+'].name" value="'+_obj.uid+'" />'+
						'<input value="'+_obj.name+'" readonly="true" /></td>'+
						'<td>'+tempSel+'</td>'+
						'<td><input name="forceFollList['+m+'].department" value="'+_obj.department+'" /></td>'+
						'<td><input name="forceFollList['+m+'].duty" value="'+(_obj.duty||"")+'" /></td>'+
						'<td><input name="forceFollList['+m+'].downlimit" value="'+formatMillions(_obj.downlimit)+'" type="number" /></td>'+
						'<td><input name="forceFollList['+m+'].toplimit" value="'+formatMillions(_obj.toplimit)+'" type="number" /></td>'+
						'<td><input name="forceFollList['+m+'].remark" value="'+_obj.remark+'" readonly="true" /></td>'+
						'<td><a class="forceDelBtn" ind="'+m+'" uid="'+_obj.uid+'" fid="'+_obj.forceFollowId+'" href="javascript:void(0)" >删除</a></td></tr>';
				 $("#forceTbody").append(tempHtml);
				}	
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getSchemeByProjectid(){
	var ctx=$("#ctx").val();
	var projectId=$("#projectid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/FollowSchemeController/getSchemeByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				 $("#schemeid").val(msg.baseModel.schemeId);
				 $("#uploadSchemeId").val(msg.baseModel.schemeId);
				 $("#subscribeStartInp").val((msg.baseModel.subscribeStartDate?new Date(msg.baseModel.subscribeStartDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 $("#subscribeEndtInp").val((msg.baseModel.subscribeEndDate?new Date(msg.baseModel.subscribeEndDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 $("#payStartInp").val((msg.baseModel.payStartDate?new Date(msg.baseModel.payStartDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 $("#payEndInp").val((msg.baseModel.payEndDate?new Date(msg.baseModel.payEndDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 $("#payReleaseDateInp").val((msg.baseModel.projectReleaseDate?new Date(msg.baseModel.projectReleaseDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 $("#personamt").val(msg.baseModel.personamt);
				 // $("#yxpersonamt").val(msg.baseModel.yxpersonamt);
				 // $("#jtpersonamt").val(msg.baseModel.jtpersonamt);
				 $("#followAmount").val(msg.baseModel.followAmount / 10000);
				 $("#fundPeake").val(msg.baseModel.fundPeake);
				 $("#maxamount").val(msg.baseModel.maxamount / 10000);
				 $("#minamount").val(msg.baseModel.minamount / 10000);
				 $("#followAmountDesc").val(msg.baseModel.followAmountDesc);
				 $("#groupForceRatio").val(msg.baseModel.groupForceRatio);
				 $("#groupForceAmount").val(msg.baseModel.groupForceAmount / 10000);
				 $("#compForceRatio").val(msg.baseModel.compForceRatio);
				 $("#compForceAmount").val(msg.baseModel.compForceAmount / 10000);
				 $("#compChoiceRatio").val(msg.baseModel.compChoiceRatio);
				 $("#compChoiceAmount").val(msg.baseModel.compChoiceAmount / 10000);
				 $("#leverageDes").val(msg.baseModel.leverageDes);
				 $("#subscribeRemind").val(msg.baseModel.subscribeRemind);
				 // $("#followChemeLink").val(msg.baseModel.followChemeLink);
				 $("#schemeLinkTd").html(splitSchemeLink(msg.baseModel.followChemeLink));
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function splitSchemeLink(_str){
	returnStr = "";
	if(_str && _str.length>0){
		schemeLinkArr = _str.split(";");
		$.each(schemeLinkArr, function(ind, val){
			returnStr += '<div><a href="../front/files/'+val+'">'+(ind+1)+'、'+val+'</a>&nbsp;&nbsp;<a class="delSchemeLink" ind="'+ind+'" href="javascript:void(0);">X</a></div>';
		})
	}
	return returnStr;
}
function deleteSchemeLinkFunc(){
	var _ind = parseInt($(this).attr("ind"));
	var _linkStr = "";
	schemeLinkArr.splice(_ind, 1);
	if(schemeLinkArr.length > 0){
		_linkStr = schemeLinkArr.join(";");
	}
	
	$.ajax({
		type:'post',//可选get
		url:'../FollowSchemeController/deleteSchemeLink.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'schemeId':$("#schemeid").val(),
			'schemeLink':_linkStr
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				$("#schemeLinkTd").html(splitSchemeLink(_linkStr));
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getProjectDetail(){
	var ctx=$("#ctx").val();
	var projectId=$("#projectid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ProjectBasicController/getProjectById.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				// 为父页面填充导航项目名称
				// $("#navProLayer #pageProName").text(msg.baseModel.projectName);

				$("#projectName").val(msg.baseModel.projectName);
				$("#floorArea").val(msg.baseModel.floorArea);
				$("#structArea").val(msg.baseModel.structArea);
				$("#plotArea").val(msg.baseModel.plotArea);
				$("#saleStructArea").val(msg.baseModel.saleStructArea);
				$("#groundInp").val((new Date(msg.baseModel.groundDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#groundAmount").val(msg.baseModel.groundAmount);
				$("#returndate").val(msg.baseModel.returndate);
				$("#buildareaprice").val(msg.baseModel.buildareaprice);
				$("#groundType").val(msg.baseModel.groundType);
				$("#groundPosition").val(msg.baseModel.groundPosition);
				// $("#projectarea").val(msg.baseModel.projectarea);
				$("#groundPositioning").val(msg.baseModel.groundPositioning);
				$("#groundPlanning").val(msg.baseModel.groundPlanning);
				$("#planFold").val(msg.baseModel.planFold);
				$("#planRent").val(msg.baseModel.planRent);
				$("#planIrr").val(msg.baseModel.planIrr);
				$("#planGrossMargin").val(msg.baseModel.planGrossMargin);
				$("#planMoic").val(msg.baseModel.planMoic);
				$("#stageStartInp").val((new Date(msg.baseModel.planStageStartDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#stageOpenInp").val((new Date(msg.baseModel.planStageOpenDate)).format('yyyy-MM-dd hh:mm:ss'));
				// $("#peakInp").val((new Date(msg.baseModel.planPeakeDate)).format('yyyy-MM-dd hh:mm:ss'));
				// $("#cashflowReturnInp").val((new Date(msg.baseModel.planCashflowReturnDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#deliverInp").val((new Date(msg.baseModel.planDeliverDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#carryoverInp").val((new Date(msg.baseModel.planCarryoverDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#liquidateInp").val((new Date(msg.baseModel.planLiquidateDate)).format('yyyy-MM-dd hh:mm:ss'));
				$("#planPropertyScheme").val(msg.baseModel.planPropertyScheme);
				$("#planFinanceCalculate").val(msg.baseModel.planFinanceCalculate);
				$("#corpPartnerBackground").val(msg.baseModel.corpPartnerBackground);
				$("#corpContributiveRatio").val(msg.baseModel.corpContributiveRatio);
				$("#corpBoardMember").val(msg.baseModel.corpBoardMember);
				$("#corpVoteRule").val(msg.baseModel.corpVoteRule);
				$("#restAnswerMail").val(msg.baseModel.restAnswerMail);
				// $("#restAnswerLink").val(msg.baseModel.restAnswerLink);
				$("#restProjectManagers").val(msg.baseModel.restProjectManagers);
				$("#restFollowerManagers").val(msg.baseModel.restFollowerManagers);
				$("#riskDisclaimerDes").val(msg.baseModel.riskDisclaimerDes);
				// $("#schemeProtocol").val(msg.baseModel.schemeProtocol);
 				$("#protocalLinkTd").html(splitSchemeProtocal(msg.baseModel.schemeProtocol));
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function splitSchemeProtocal(_str){
	returnStr = "";
	if(_str && _str.length>0){
		protocalArr = _str.split(";");
		$.each(protocalArr, function(ind, val){
			returnStr += '<div><a href="../front/files/'+val+'">'+(ind+1)+'、'+val+'</a>&nbsp;&nbsp;<a class="delProtocalLink" ind="'+ind+'" href="javascript:void(0);">X</a></div>';
		})
	}
	return returnStr;
}
function deleteSchemeProtocalFunc(){
	var _ind = parseInt($(this).attr("ind"));
	var _linkStr = "";
	protocalArr.splice(_ind, 1);
	if(protocalArr.length > 0){
		_linkStr = protocalArr.join(";");
	}
	
	$.ajax({
		type:'post',//可选get
		url:'../ProjectBasicController/deleteSchemeProtocal.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':$("#projectid").val(),
			'protocalLink':_linkStr
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				$("#protocalLinkTd").html(splitSchemeProtocal(_linkStr));
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function forceDelFunc(argument) {
	var _forceFollowId = $(this).attr("fid");
	var _uid = $(this).attr("uid");
	var _ind = $(this).attr("ind");
	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/delete.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'forceFollowId':_forceFollowId
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				$("#force_row_"+_ind).remove();
				if(forceObj[_uid]) delete forceObj[_uid];
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getAllUserData(){
	var _nameVal = $.trim($("#forceDialogLayer #searUserInp").val());
	$.ajax({
		type:'post',//可选get
		url:'../userController/getUserListByName.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'uname':_nameVal,
			'projectId':projectId,
			"startPage":0,
			"pageSize":6
		},
		success:function(msg){
			if(msg.success){
				allUserList=msg.dataDto;
				loadAllUserData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadAllUserData (argument) {
	$("#allUserTbody").empty();
	if(allUserList && allUserList.length > 0){
		var tempHtml = "";
		var ckStr = "";
		$.each(allUserList, function(ind, val){
			ckStr = "";
			if(forceObj[val.uid]){
				 ckStr = 'checked="checked" disabled="true"';
			}else if(tempForceObj[val.uid]){
				ckStr = 'checked="checked"';
			}
			tempHtml +=
			'<tr><td><input name="userCk" type="checkbox" class="ckSTY" '+ckStr+' uid="'+val.uid+'" ind="'+ind+'"></td>'+
			'<td>'+val.uname+'</td>'+
			'<td>'+val.samaccountname+'</td>'+
			// '<td><input id="subTypeInp_'+ind+'" value="集团强投包" /></td>'+
			'<td>'+val.service+'</td>'+
			// '<td>'+""+'</td>'+
			// '<td><input id="downLimitInp_'+ind+'" type="number" value="'+(val.downlimit||50000)+'" /></td>'+
			// '<td><input id="topLimitInp_'+ind+'" type="number" value="'+(val.toplimit||200000)+'" /></td>'+
			'</tr>';
		});
		$("#allUserTbody").html(tempHtml);
	}
}
function addRows(argument) {
	var leng = $("#forceTbody").children().length;
	$.each(tempAddForceObj, function(ind, val){
		var tempHtml = '<tr>'+
				/*'<td>'+(i+1)+'</td>'+*/
				'<td><input type="hidden" name="forceFollList['+i+'].forceFollowId"  />'+
					'<input type="hidden" name="forceFollList['+i+'].forceType" value="1"  />'+
					'<input type="hidden" name="forceFollList['+i+'].name" value="'+val.uid+'" />'+
					'<input value="'+val.uname+'" readonly="true" /></td>'+
				'<td><select name="forceFollList['+i+'].company" ><option value="集团强投包" selected="selected">集团强投包</option><option value="城市强投包">城市强投包</option></select></td>'+
				'<td><input name="forceFollList['+i+'].department" value="'+val.service+'" readonly="true" /></td>'+
				'<td><input name="forceFollList['+i+'].duty" value="'+""+'" /></td>'+
				'<td><input name="forceFollList['+i+'].downlimit" value="5" type="number" /></td>'+
				'<td><input name="forceFollList['+i+'].toplimit" value="20" type="number" /></td>'+
				'<td><input name="forceFollList['+i+'].remark" value="'+val.samaccountname+'" /></td>'+
				'<td></td></tr>';
		$("#forceTbody").append(tempHtml);
		if(!tempForceObj[val.uid]) tempForceObj[val.uid] = val;
		i++;
	});
	tempAddForceObj = {};
	hideForceDialog();
}
function callForceDialog(){
	getAllUserData();
	$("#forceDialogBgLayer").show();
	$("#forceDialogLayer").show();
}
function hideForceDialog(){
	$("#forceDialogBgLayer").hide();
	$("#forceDialogLayer").hide();
	$("#forceDialogLayer #searUserInp").val("");
}
</script>
</head>
<body id="rightLayer">
<div id="basic" class="editTitle"><img src="./images/arrow_down.png" />基础信息</div>
<form id="testfrom" method="post" action="${pageContext.request.contextPath}/ProjectBasicController/saveOrUpdate.action">
<div id="basic_editor" class="editor">
<input type="hidden" name="projectId" id="newprojectId" />
	<table width="100%"><tr>
		<td class="tdTitle">项目名称</td>
		<td colspan="3"><input name="projectName" id="projectName"/></td>
	</tr><tr>
		<td class="tdTitle">占地面积</td>
		<td><input name="floorArea" id="floorArea" onkeyup="clearNoNum(this)" /> (平方米)</td>
		<td class="tdTitle">计容建面</td>
		<td><input name="structArea" id="structArea" onkeyup="clearNoNum(this)" /> (平方米)</td>
	</tr><tr>
		<td class="tdTitle">容积率</td>
		<td><input name="plotArea" id="plotArea"/></td>
		<td class="tdTitle">可销售计容建面</td>
		<td><input name="saleStructArea" id="saleStructArea" onkeyup="clearNoNum(this)" /> (平方米)</td>
	</tr><tr>
		<td class="tdTitle">土地获取时间</td>
		<td><input id="groundInp"  name="groundDate"/></td>
		<td class="tdTitle">地价总额</td>
		<td><input name="groundAmount" id="groundAmount" onkeyup="clearNoNum(this)" /> (亿元)</td>
	</tr><tr>
		<td class="tdTitle">获取方式</td>
		<td><input name="groundType" id="groundType"/></td>
		<td class="tdTitle">楼面地价</td>
		<td><input id="buildareaprice" name="buildareaprice" onkeyup="clearNoNum(this)" /> (元/平)</td>
	</tr><tr>
		<td class="tdTitle">项目区位</td>
		<td colspan="3"><textarea name="groundPosition" id="groundPosition"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">项目区域</td>
		<td colspan="3"><textarea name="projectarea" id="projectarea"></textarea></td>
	</tr><tr>
		<td class="tdTitle">产品定位</td>
		<td colspan="3"><textarea name="groundPositioning" id="groundPositioning"></textarea></td>
	</tr><tr>
		<td class="tdTitle">规划方案</td>
		<td colspan="3"><textarea name="groundPlanning" id="groundPlanning"></textarea></td>
	</tr><tr>
		<td class="tdTitle">项目均价</td>
		<td><input name="planFold" id="planFold" onkeyup="clearNoNum(this)" /> (元/平方米)</td>
		<td class="tdTitle">持有型物业租金水平</td>
		<td><input name="planRent" id="planRent" /></td>
	</tr><tr>
		<td class="tdTitle">项目IRR</td>
		<td><input name="planIrr" id="planIrr" onkeyup="clearNoNum(this)" /> (%)</td>
		<td class="tdTitle">预计销售毛利率</td>
		<td><input name="planGrossMargin" id="planGrossMargin" onkeyup="clearNoNum(this)" /> (%)</td>
	</tr><tr class="displayNone">
		<td class="tdTitle">跟投MOIC（税前）</td>
		<td><input name="planMoic" id="planMoic" onkeyup="clearNoNum(this)" /> (元)</td>
		<td class="tdTitle"></td>
		<td></td>
	</tr><tr>
		<td class="tdTitle">开工时间</td>
		<td><input id="stageStartInp" name="planStageStartDate"  /></td>
		<td class="tdTitle">开盘时间</td>
		<td><input id="stageOpenInp" name="planStageOpenDate"  /></td>
	</tr><tr>
		<!-- <td class="tdTitle">资金峰值时间</td>
		<td><input id="peakInp" name="planPeakeDate"  /></td> -->
		<!-- <td class="tdTitle">现金流回正时间</td>
		<td><input id="cashflowReturnInp" name="planCashflowReturnDate" /></td> -->
		<td class="tdTitle">现金流回正时间</td>
		<td><input id="returndate" name="returndate" /> (个月)</td>
		<td class="tdTitle">交付时间</td>
		<td><input id="deliverInp" name="planDeliverDate" /></td>
	</tr><tr>
		<td class="tdTitle">结转时间</td>
		<td><input id="carryoverInp" name="planCarryoverDate" /></td>
		<td class="tdTitle">清算时间</td>
		<td><input id="liquidateInp" name="planLiquidateDate" /></td>
	</tr><!-- <tr>
		<td class="tdTitle"></td>
		<td></td>
	</tr> --><tr>
		<td class="tdTitle">持有物业处理方案</td>
		<td colspan="3"><textarea name="planPropertyScheme" id="planPropertyScheme"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">财务测算文件</td>
		<td><input name="planFinanceCalculate" id="planFinanceCalculate"/></td>
		<td class="tdTitle"></td>
		<td></td>
	</tr><tr>
		<td class="tdTitle">合作方背景和资质</td>
		<td colspan="3"><textarea name="corpPartnerBackground" id="corpPartnerBackground"></textarea></td>
	</tr><tr>
		<td class="tdTitle">项目出资比例</td>
		<td colspan="3"><textarea name="corpContributiveRatio" id="corpContributiveRatio"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">董事会组成</td>
		<td colspan="3"><textarea name="corpBoardMember" id="corpBoardMember"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">项目公司股东会及<br>董事会表决比例<br>和表决规则</td>
		<td colspan="3"><textarea name="corpVoteRule" id="corpVoteRule"></textarea></td>
	</tr><tr>
		<td class="tdTitle">答疑邮箱地址</td>
		<td><input name="restAnswerMail" id="restAnswerMail"/></td>
		<td class="tdTitle"></td>
		<td></td>
	</tr><!-- <tr>
		<td class="tdTitle">答疑讨论区链接</td>
		<td><input name="restAnswerLink" id="restAnswerLink" /></td>
		<td class="tdTitle"></td>
		<td></td>
	</tr> --><tr>
		<td class="tdTitle">项目信息管理员</td>
		<td colspan="3"><textarea name="restProjectManagers" id="restProjectManagers"></textarea></td>
	</tr><tr>
		<td class="tdTitle">项目跟投管理员</td>
		<td colspan="3"><textarea name="restFollowerManagers" id="restFollowerManagers"></textarea></td>
	</tr><tr>
		<td class="tdTitle">风险与免责</td>
		<td colspan="3"><textarea name="riskDisclaimerDes" id="riskDisclaimerDes"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">跟投协议</td>
		<td><input name="schemeProtocol" id="schemeProtocol"/><button>浏览</button></td>
		<td class="tdTitle"></td>
		<td></td>
	</tr>
	<tr height="40">
		<td></td>
		<td align="left"><button>保&nbsp;&nbsp;存</button></td>
		<td></td>
		<td></td>
	</tr></table>
</div>
</form>
<div id="scheme" class="editTitle"><img src="./images/arrow_down.png" />跟投计划</div>
<form id="schemeForm"  method="post" action="${pageContext.request.contextPath}/FollowSchemeController/saveOrUpdate.action">
<div id="scheme_editor" class="editor displayNone">
		<input type="hidden" name="projectId" id="schemeProjectid"/>
		<input type="hidden" name="schemeId" id="schemeid"/>
	<table width="100%"><tr>
		<td class="tdTitle">认购开始时间</td>
		<td><input id="subscribeStartInp" name="subscribeStartDate"  /></td>
		<td class="tdTitle">认购结束时间</td>
		<td><input id="subscribeEndtInp" name="subscribeEndDate"  /></td>
	</tr><tr>
		<td class="tdTitle">付款开始时间</td>
		<td><input id="payStartInp" name="payStartDate"  /></td>
		<td class="tdTitle">付款结束时间</td>
		<td><input id="payEndInp" name="payEndDate"  /></td>
	</tr><tr>
		<td class="tdTitle">项目发布时间</td>
		<td><input id="payReleaseDateInp" name="projectReleaseDate"  /></td>
		<td class="tdTitle"><!-- 员工可投总额 --></td>
		<td><!-- <input id="personamt" name="personamt"  /> --></td>
	</tr><!-- <tr>
		<td class="tdTitle">一线可跟投总额</td>
		<td><input id="yxpersonamt"  name="yxpersonamt" /></td>
		<td class="tdTitle">集团可跟投总额</td>
		<td><input id="jtpersonamt" name="jtpersonamt"  /></td>
	</tr> --><tr>
		<td class="tdTitle">资金峰值</td>
		<td><input name="fundPeake" id="fundPeake" onkeyup="clearNoNum(this)" /> (亿元)</td>
		<td class="tdTitle">跟投总额(含杠杆)</td>
		<td><input name="followAmount" id="followAmount" onkeyup="clearNoNum(this)" /> (万元)</td>
	</tr><!-- <tr>
		<td class="tdTitle">可跟投总额包括</td>
		<td colspan="3"><textarea name="followAmountDesc" id="followAmountDesc"></textarea></td>
	</tr> --><tr>
		<td class="tdTitle">集团强投包比例</td>
		<td><input name="groupForceRatio" id="groupForceRatio" onkeyup="clearNoNum(this)" /> (%)</td>
		<td class="tdTitle">集团强投包总额</td>
		<td><input name="groupForceAmount" id="groupForceAmount" onkeyup="clearNoNum(this)" /> (万元)</td>
	</tr><tr>
		<td class="tdTitle">城市公司强投包比例</td>
		<td><input name="compForceRatio" id="compForceRatio" onkeyup="clearNoNum(this)" /> (%)</td>
		<td class="tdTitle">城市公司强投包总额</td>
		<td><input name="compForceAmount" id="compForceAmount" onkeyup="clearNoNum(this)" /> (万元)</td>
	</tr><tr>
		<td class="tdTitle">选投包比例(无杠杆)</td>
		<td><input name="compChoiceRatio" id="compChoiceRatio" onkeyup="clearNoNum(this)" /> (%)</td>
		<td class="tdTitle">选投包总额(无杠杆)</td>
		<td><input name="compChoiceAmount" id="compChoiceAmount" onkeyup="clearNoNum(this)" /> (万元)</td>
	</tr><tr>
		<td class="tdTitle">选投包认购金额下限</td>
		<td><input name="minamount" id="minamount" onkeyup="clearNoNum(this)" /> (万元)</td>
		<td class="tdTitle">选投包认购金额上限</td>
		<td><input name="maxamount" id="maxamount" onkeyup="clearNoNum(this)" /> (万元)</td>
	</tr><tr>
		<td class="tdTitle">杠杆认购说明</td>
		<td colspan="3"><textarea name="leverageDes" id="leverageDes"></textarea></td>
	</tr><tr>
		<td class="tdTitle">项目跟投小组</td>
		<td colspan="3"><textarea name="followAmountDesc" id="followAmountDesc"></textarea></td>
	</tr><tr>
		<td class="tdTitle">募集方式</td><!-- "认购提醒"字段变更为"募集方式" -->
		<td colspan="3"><textarea name="subscribeRemind" id="subscribeRemind"></textarea></td>
	</tr><tr class="displayNone">
		<td class="tdTitle">跟投方案下载链接</td>
		<td colspan="3"><textarea name="followChemeLink" id="followChemeLink"></textarea></td>
	</tr>
	<tr height="40">
		<td></td>
		<td align="left"><button>保&nbsp;&nbsp;存</button></td>
		<td></td>
		<td></td>
	</tr></table>
</div>
</form>
<div id="force" class="editTitle"><img src="./images/arrow_down.png" />强制跟投名单</div>
<form id="forceForm" method="post" action="${pageContext.request.contextPath}/ForceFollowController/saveOrUpdate.action">
<input type="hidden" name="projectid" id="forceProjectId"/>
<div id="force_editor" class="editor displayNone" style="">
	<table id="forceTable" width="100%" border="1"><thead><tr class="trTitle">
		<!-- <td rowspan="2" width="4%">序号</td> -->
		<td rowspan="2" width="12%">姓名</td>
		<td rowspan="2" width="12%">认购类型</td>  <!-- "所属公司"字段改为：认购类型 -->
		<td rowspan="2" width="15%">部门</td>
		<td rowspan="2" width="11%">职务</td>
		<td colspan="2" width="30%">个人额度范围</td>
		<td rowspan="2" width="12%">备注</td>
		<td rowspan="2">操作</td>
	</tr><tr class="trTitle">
		<td>下限(万元)</td>
		<td>上限(万元)</td>
	</tr></thead><tbody id="forceTbody">
	</tbody></table>
	<div class="btnBox"><button id="addForceRecord" type="button">新增</button><button>保存</button></div>
</div>
</form>
<div id="subscribe" class="editTitle displayNone"><img src="./images/arrow_down.png" />认购信息</div>
<form id="subForm" method="post" action="${pageContext.request.contextPath}/subscribe/saveOrUpdate.action">
<div id="subscribe_editor" class="editor displayNone">
	<input type="hidden" id="subProjectId" name="projectId"/>
	<table id="subTable" width="100%" border="1"><thead><tr class="trTitle">
		<td rowspan="2" width="4%">序号</td>
		<td colspan="3" height="25">跟投额度</td>
		<td colspan="3">跟投情况</td>
	</tr><tr class="trTitle">
		<td width="16%" height="25">跟投性质</td>
		<td width="16%">跟投员工</td>
		<td width="16%">总额指导上限(元)</td>
		<td width="16%">出资认购(元)</td>
		<td width="16%">杠杆认购(元)</td>
		<td>总额(万元)</td>
	</tr></thead><tbody id="subTbody">
		<tr>
			<td>1<input type="hidden" name="subscribeList[0].subscribeId" id="sub0subscribeId" /></td>
			<td><input name="subscribeList[0].followNature" id="sub0followNature" value=""></td>
			<td><input name="subscribeList[0].followStaff" id="sub0followStaff" value=""></td>
			<td><input name="subscribeList[0].amountToplimit" id="sub0amountToplimit" value="0"></td>
			<td><input name="subscribeList[0].contributiveSubscribe" id="sub0contributiveSubscribe" value="0"></td>
			<td><input name="subscribeList[0].leverageSubscribe" id="sub0leverageSubscribe" value="0"></td>
			<td><input name="subscribeList[0].subscribeAmountTotal" id="sub0subscribeAmountTotal" value="0"></td>
		</tr>
		<tr>
			<td>2<input type="hidden" name="subscribeList[1].subscribeId"  id="sub1subscribeId"/></td>
			<td><input name="subscribeList[1].followNature" id="sub1followNature" value=""></td>
			<td><input name="subscribeList[1].followStaff" id="sub1followStaff" value=""></td>
			<td><input name="subscribeList[1].amountToplimit" id="sub1amountToplimit" value="0"></td>
			<td><input name="subscribeList[1].contributiveSubscribe" id="sub1contributiveSubscribe" value="0"></td>
			<td><input name="subscribeList[1].leverageSubscribe" id="sub1leverageSubscribe" value="0"></td>
			<td><input name="subscribeList[1].subscribeAmountTotal" id="sub1subscribeAmountTotal" value="0"></td>
		</tr>
		<tr>
			<td>3<input type="hidden" name="subscribeList[2].subscribeId"  id="sub2subscribeId"/></td>
			<td><input name="subscribeList[2].followNature" id="sub2followNature" value=""></td>
			<td><input name="subscribeList[2].followStaff" id="sub2followStaff" value=""></td>
			<td><input name="subscribeList[2].amountToplimit" id="sub2amountToplimit" value="0"></td>
			<td><input name="subscribeList[2].contributiveSubscribe" id="sub2contributiveSubscribe" value="0"></td>
			<td><input name="subscribeList[2].leverageSubscribe" id="sub2leverageSubscribe" value="0"></td>
			<td><input name="subscribeList[2].subscribeAmountTotal" id="sub2subscribeAmountTotal" value="0"></td>
		</tr>
	</tbody></table>
	<div class="btnBox">
		<button id="addSubPackage" style="display:none">新增</button><button>保存</button>
	</div>
</div>
</form>
<div id="uploadAttach" class="editTitle"><img src="./images/arrow_down.png" />附件上传</div>
<div id="uploadAttach_editor" class="editor displayNone">
<form id="uploadProtocalForm" method="post" action="../FileUpLoadController/upload.action" enctype="multipart/form-data">
	<table width="100%"><tr>
		<td class="tdTitle">跟投协议：</td>
		<td id="protocalLinkTd"></td>
	</tr><tr>
		<td></td>
		<td>
			<input type="file" name="file" value="浏览"/>
			<input type="hidden" name="uploadProId" id="uploadProId" value="065c1c88-f98e-4b29-a6d2-fed41d6fd4f6"/>
		</td>
	</tr><tr>
		<td></td>
		<td>
			<button id="listbtn" type="submit" style="margin-left:5px;">提交</button>
			<span class="tip_STY">*：1、跟投协议附件仅支持.doc和.docx格式  &nbsp;&nbsp;2、需要上传多个协议附件时请依次上传，单次提交只允许上传一个附件</span>
		</td>
	</tr></table>
</form>
<hr style="border: #D3D3D3 1px dotted;margin: 5px 0px;" />
<form id="uploadForm" method="post" action="../FileUpLoadController/uploadScheme.action" enctype="multipart/form-data">
	<table width="100%"><tr>
		<td class="tdTitle" valign="top">跟投方案：</td>
		<td id="schemeLinkTd"></td>
	</tr><tr>
		<td></td>
		<td>
			<input type="file" name="file" value="浏览"/>
			<input type="hidden" name="uploadProId_1" id="uploadProId_1" value="065c1c88-f98e-4b29-a6d2-fed41d6fd4f6"/>
			<input type="hidden" name="uploadSchemeId" id="uploadSchemeId" value="">
		</td>
	</tr><tr>
		<td></td>
		<td>
			<button id="listbtn" type="submit" style="margin-left:5px;">提交</button>
			<span class="tip_STY">*：1、跟投方案附件仅支持.doc和.docx格式  &nbsp;&nbsp;2、需要上传多个方案附件时请依次上传，单次提交只允许上传一个附件</span>
		</td>
	</tr></table>
</form>
</div>
</body>
<div id="forceDialogBgLayer" style="display:none;"></div>
<div id="forceDialogLayer" style="display:none;">
	<div class="dialogSTY">
		<div class="searDiv">
			<div class="tipTitle">勾选员工后，请单击"确定"添加到列表</div>
			<input id="searUserInp" placeholder="请输入用户名" type="search" /><button id="searUserBtn">搜索</button>
		</div>
		<div class="contentDiv"><table border="1"><thead><tr>
			<td rowspan="2" width="25" height="28"></td>
			<td rowspan="2" width="110">中文名</td>
			<td rowspan="2" width="120">帐号</td>
			<!-- <td rowspan="2" width="150">认购类型</td> -->
			<td rowspan="2" width="150">部门</td>
			<!-- <td rowspan="2" width="150">职务</td> -->
			<!-- <td colspan="2">个人额度范围</td> -->
			<!-- <td rowspan="2">备注</td> -->
		</tr><!-- <tr>
			<td>下限(元)</td>
			<td>上限(元)</td>
		</tr> --></thead>
		<tbody id="allUserTbody">
			<tr><td><input name="userCk" type="checkbox" class="ckSTY"></td>
			<td>张三</td>
			<td>zhangsan</td>
			<!-- <td><input value="集团强投包" /></td> -->
			<td>人力资源部</td>
			<!-- <td>集团总裁</td> -->
			<!-- <td><input type="number" value="50000" /></td>
			<td><input type="number" value="200000" /></td> -->
			</tr>
		</tbody></table></div>
		<div class="btnDiv"><button id="okBtn">确定</button><button id="cancelBtn">关闭</button></div>
	</div>
</div>
</html>