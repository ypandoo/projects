<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<title>特别跟投人员设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>

<style type="text/css">
body{font-size: 12px;}
/*#specialBody #addSpecialBtn{float: left;width: 100px;height: 30px;line-height: 30px;text-align:center;cursor: pointer;}*/
#specialBody #specialTable{border-spacing: 1px; border-collapse: collapse;border:1px solid #C0BEBE;font-size: 0.9em;}
#specialBody #specialTable .trTitle{color: #727070;}
#specialBody #specialTable thead{background: url(images/thead_bg.png);}
#specialBody #specialTable td{text-align: center;border:1px solid #C0BEBE;}
#specialBody #specialTable tbody td{height: 30px;}
#specialBody #specialTable tbody input{padding: 0px 2px;width: 70%;text-align: center;}

#speDialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#speDialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#speDialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 1000px;height: 360px;margin: 70px auto;}
#speDialogLayer .dialogSTY .tipTitle{float:left;padding: 8px 15px;}
#speDialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#speDialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#speDialogLayer .dialogSTY .contentDiv{width: 96%;height: 275px;margin: 3px auto;border: 0px solid #e8e8e8;overflow: hidden;}
#speDialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#speDialogLayer .dialogSTY .contentDiv table td{border: 1px solid #e8e8e8;}
#speDialogLayer .dialogSTY .contentDiv table thead{background: url(images/thead_bg.png);text-align: center;}
#speDialogLayer .dialogSTY .contentDiv table tbody td{padding: 3px 5px;text-align: center;}
#speDialogLayer .dialogSTY .contentDiv table input{padding: 0px 3px;margin: 0px;width: 70px;text-align: center;}
#speDialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#speDialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#speDialogLayer button{width: 50px;height: 25px;margin: 0px 5px;}
</style>
<script type="text/javascript">
var specialList = [];
var allUserList = [];
var specialObj = {};
var tempSpecialObj = {};
$(function(){
	initSPCParams();
	initSPCListeners();
	initSPCPages();
});

function initSPCParams(argument) {
	// body...
}
function initSPCListeners(argument) {

	$("#addSpecialBtn").click(callDialog);
	$("#speDialogLayer #searUserBtn").click(function(){
		getAllUserData();
	});
	$("#speDialogLayer #okBtn").click(function(ev){
		addSpecialData(this,ev);
		// hideDialog();
	});
	$("#speDialogLayer #cancelBtn").click(hideDialog);
	$("#specialTbody .saveBtn").live("click", updForce);
	$("#specialTbody .delBtn").live("click", deleteForce);
}
function initSPCPages(argument) {
	getSpecialData();
}
function getSpecialData(){
	var ctx=$("#ctx").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'forceType': "2"
		},
		success:function(msg){
			if(msg.success){
				specialList = msg.dataDto;
				loadSpecialData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadSpecialData(){
	$("#specialTbody").empty();
	specialObj = {};
	if(specialList && specialList.length > 0){
		var tempHtml = "";
		$.each(specialList, function(ind, val){
			specialObj[val.uid] = val;
			tempHtml += 
			'<tr><td>'+(ind+1)+'</td>'+
			'<td>'+val.name+'</td>'+
			'<td>'+val.company+'</td>'+
			'<td>'+val.department+'</td>'+
			'<td>'+val.duty+'</td>'+
			'<td><input id="updDownLimitInp_'+ind+'" type="number" value="'+val.downlimit+'" /></td>'+
			'<td><input id="updTopLimitInp_'+ind+'" type="number" value="'+val.toplimit+'" /></td>'+
			'<td>'+val.remark+'</td>'+
			'<td><a class="saveBtn" sid="'+val.forceFollowId+'" ind="'+ind+'" href="javascript:void(0)">保存</a>'+
			'&nbsp;&nbsp;<a class="delBtn" sid="'+val.forceFollowId+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#specialTbody").html(tempHtml);
	}
}
function getAllUserData(){
	var _nameVal = $.trim($("#searUserInp").val());
	$.ajax({
		type:'post',//可选get
		url:'../userController/getUserListByName.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'uname':_nameVal,
			'projectId':projectId,
			"startPage":0,
			"pageSize":5
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
			if(tempSpecialObj[val.uid]){
				 ckStr = 'checked="checked" disabled="true"';
			}
			tempHtml +=
			'<tr><td><input name="userCk" type="checkbox" class="ckSTY" '+ckStr+' uid="'+val.uid+'" ind="'+ind+'"></td>'+
			'<td>'+val.uname+'</td>'+
			'<td>'+val.samaccountname+'</td>'+
			'<td><input id="subTypeInp_'+ind+'" value="集团强投包" /></td>'+
			'<td>'+val.service+'</td>'+
			'<td>'+""+'</td>'+
			'<td><input id="downLimitInp_'+ind+'" type="number" value="'+(val.downlimit||50000)+'" /></td>'+
			'<td><input id="topLimitInp_'+ind+'" type="number" value="'+(val.toplimit||200000)+'" /></td></tr>';
		});
		$("#allUserTbody").html(tempHtml);
	}
}
function addSpecialData(_this, _ev){
	var _list = [];
	var _tempObj = null;
	var _ind = null;
	$("#allUserTbody input[name=userCk]").each(function(){
		_ind = $(this).attr("ind");
		if($(this).attr("checked") == "checked" && !$(this).attr("disabled")){
			_tempObj = {
				"name": allUserList[_ind].uid||"",
				"department": allUserList[_ind].service||"",
				"duty": allUserList[_ind].duty||"",
				"company":$("#subTypeInp_"+_ind).val(),
				"topLimit":$("#topLimitInp_"+_ind).val(),
				"downLimit":$("#downLimitInp_"+_ind).val(),
				"remark": allUserList[_ind].samaccountname,
				"forceType": "2"
			};
			_list.push(_tempObj);
			tempSpecialObj[allUserList[_ind].uid] = allUserList[_ind];
		}
	});
	if(_list.length <= 0){
		alert("请选择用户!");
		return false;
	}

	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/insert.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			"objStr": JSON.stringify(_list)
		},
		success:function(msg){
			if(msg.success){
				alert("保存成功!");
				specialObj = tempSpecialObj;
				getAllUserData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function updForce() {
	var _forceFollowId = $(this).attr("sid");
	var _ind = $(this).attr("ind");
	var _param = {
		'downLimit':$("#updDownLimitInp_"+_ind).val(),
		'topLimit':$("#updTopLimitInp_"+_ind).val()
	};
	var _list = [_param];
	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/update.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'forceFollowId':_forceFollowId,
			'objStr':JSON.stringify(_list)
		},
		success:function(msg){
			if(msg.success){
				alert("修改成功!");
				getSpecialData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function deleteForce(argument) {
	var _forceFollowId = $(this).attr("sid");
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
				getSpecialData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function callDialog(){
	getAllUserData();
	tempSpecialObj = specialObj;
	$("#speDialogBgLayer").show();
	$("#speDialogLayer").show();
}
function hideDialog(){
	tempSpecialObj = {};
	getSpecialData();
	$("#speDialogBgLayer").hide();
	$("#speDialogLayer").hide();
	$("#searUserInp").val("");
}
</script>
</head>
<body>
<div id="specialBody">
	<div><button id="addSpecialBtn">新增</button></div><br>
	<table id="specialTable" width="100%" border="1"><thead><tr class="trTitle">
			<td rowspan="2" width="40">序号</td>
			<td rowspan="2" width="100">姓名</td>
			<td rowspan="2" width="120">认购类型</td>  <!-- "所属公司"字段改为：认购类型 -->
			<td rowspan="2" width="130">部门</td>
			<td rowspan="2" width="130">职务</td>
			<td colspan="2">个人额度范围</td>
			<td rowspan="2" width="130">备注</td>
			<td rowspan="2">操作</td>
		</tr><tr class="trTitle">
			<td width="140">下限(元)</td>
			<td width="140">上限(元)</td>
		</tr></thead><tbody id="specialTbody">
		<!-- <tr><td>1</td>
			<td>张三</td>
			<td>集团强投包</td>
			<td>人力资源部</td>
			<td>集团总裁</td>
			<td><input type="number" value="100000" /></td>
			<td><input type="number" value="200000" /></td>
			<td></td>
			<td><a href="javascript:void(0)">保存</a>&nbsp;&nbsp;
			<a href="javascript:void(0)">删除</a></td></tr> -->
	</tbody></table>
</div>
</body>
<div id="speDialogBgLayer" style="display:none;"></div>
<div id="speDialogLayer" style="display:none;">
	<div class="dialogSTY">
		<div class="searDiv">
			<div class="tipTitle">勾选员工后，请记得保存</div>
			<input id="searUserInp" placeholder="请输入用户名" type="search" /><button id="searUserBtn">搜索</button>
		</div>
		<div class="contentDiv"><table border="1"><thead><tr>
			<td rowspan="2" width="25"></td>
			<td rowspan="2" width="110">中文名</td>
			<td rowspan="2" width="120">帐号</td>
			<td rowspan="2" width="150">认购类型</td>
			<td rowspan="2" width="150">部门</td>
			<td rowspan="2" width="150">职务</td>
			<td colspan="2">个人额度范围</td>
			<!-- <td rowspan="2">备注</td> -->
		</tr><tr>
			<td>下限(元)</td>
			<td>上限(元)</td>
		</tr></thead>
		<tbody id="allUserTbody">
			<tr><td><input name="userCk" type="checkbox" class="ckSTY"></td>
			<td>张三</td>
			<td>zhangsan</td>
			<td><input value="集团强投包" /></td>
			<td>人力资源部</td>
			<td>集团总裁</td>
			<td><input type="number" value="50000" /></td>
			<td><input type="number" value="200000" /></td></tr>
		</tbody></table></div>
		<div class="btnDiv"><button id="okBtn">保存</button><button id="cancelBtn">关闭</button></div>
	</div>
</div>
</html>