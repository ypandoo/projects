<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护平台 - 项目列表维护</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
#sysManageLayer #proTable{width: 100%;border-spacing: 1px;border: 1px solid #e8e8e8;}
#sysManageLayer #searchLayer{text-align: right;width: 95%;margin: 10px auto 0px;}
#sysManageLayer #proTable{border-spacing: 1px;border-collapse: collapse;width: 95%;margin: 5px auto;font-size: 1em;border: 1px solid #e8e8e8;}
#sysManageLayer #proTable thead{background: url(images/thead_bg.png);}
#sysManageLayer #proTable tbody{font-size: 1.2em;}
#sysManageLayer #proTable td{text-align: center;border: 1px solid #e8e8e8;}
#sysManageLayer #proTable td a{color: #21B4F6;}
#sysManageLayer #proTable td a:hover{text-decoration: underline;}
#sysManageLayer #addProject{line-height: 35px;/*width: 95%;*/margin: 0px auto;float: left;}
#sysManageLayer #addProject a{color: #21B4F6;}
#sysManageLayer #addProject a img{vertical-align:middle;border:none;}
</style>
<script type="text/javascript">
var proList = [];
$(function(){
	getManageProjectList();
	initListeners();
});
function getManageProjectList (argument) {
	var ctx=$("#ctx").val();
	var projectName=$("#projectNameList").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/UserProjectRelateController/getUserManageProjectList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectName':projectName},
		success:function(msg){
			if(msg.success){
				proList=msg.dataDto;
				loadProData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
	
}
function initListeners (argument) {
	$("#btnSerarchList").click(function(){
		getManageProjectList();
	});

	$("#proTbody").on("click",".saveAddBtn", addProject);
	$("#proTbody").on("click",".updBtn", updProject);
	$("#proTbody").on("click",".cancelUpdBtn", cancelUpdProject);
	$("#proTbody").on("click",".saveUpdBtn", saveUpdProject);
}
function delProject(projectId){
	if(confirm("是否确认删除?")){
		var ctx=$("#ctx").val();
		$.ajax({
			type:'post',//可选get
			url:ctx+'/UserProjectRelateController/deleteProject.action',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{'projectId':projectId},
			success:function(msg){
				if(msg.success){
					$("#projectNameList").val("");
					getManageProjectList();
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
function loadProData (argument) {
	$("#proTbody").empty();
	if(proList && proList.length > 0){
		var tempHtml = "";
		$.each(proList, function(ind, val){
			tempHtml +=
			'<tr><td height="40">'+(ind+1)+'</td>'+
				'<td class="nameTd">'+val.projectName+'</td>'+
				'<td class="areaTd">'+val.projectArea+'</td>'+
				'<td><a class="updBtn" ind="'+ind+'" href="javascript:void(0);">修改</a>&nbsp;&nbsp;'+
				'<a href="javascript:delProject(\''+val.projectId+'\')">删除</a>&nbsp;&nbsp;'+
				'<a class="cancelUpdBtn" ind="'+ind+'" href="javascript:void(0);" style="display:none;">取消</a></td></tr>';
		});
		$("#proTbody").html(tempHtml);
	}
}
function addProRow(){
	var leng = $("#proTbody tr").length;
	var tempHtml = '<tr><td height="40">'+(leng+1)+'</td>'+
						'<td><input id="nameInp_'+leng+'" /></td>'+
						'<td><input id="areaInp_'+leng+'" /></td>'+
						'<td><a class="saveAddBtn" ind="'+leng+'" href="javascript:void(0);">保存</a></td>'+
					'</tr>';
	$("#proTbody").append(tempHtml);
}
function addProject(_ev){
	var _ind = $(this).attr("ind");
	var _nameInpVal = $.trim($("#nameInp_"+_ind).val());
	var _areaInpVal = $.trim($("#areaInp_"+_ind).val());
	if(_nameInpVal.length <= 0){
		alert("请输入项目名！");
	}else if(_areaInpVal.length <= 0){
		alert("请填写项目所在区域！");
	}else{
		 saveAddProject(_nameInpVal,_areaInpVal);
	}
}
function saveAddProject(_nameInpVal,_areaInpVal){
	var ctx=$("#ctx").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/UserProjectRelateController/saveUserProject.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectName':_nameInpVal,"projectArea":_areaInpVal},
		success:function(msg){
			if(msg.success){
				getManageProjectList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function updProject() {
	var _ind = $(this).attr("ind");
	$(this).text("保存").removeClass("updBtn").addClass("saveUpdBtn");
	$(this).next(".cancelUpdBtn").show();
	$(this).parent().prevAll(".nameTd").html('<input id="nameInp_'+_ind+'" value="'+proList[_ind].projectName+'" />');
	$(this).parent().prevAll(".areaTd").html('<input id="areaInp_'+_ind+'" value="'+proList[_ind].projectArea+'" />');
}
function saveUpdProject() {
	var _ind = $(this).attr("ind");
	var _proid = proList[_ind].projectId;
	var _name = $("#nameInp_"+_ind).val();
	var _area = $("#areaInp_"+_ind).val();
	if($.trim(_name) == ""){
		alert("请输入项目名！");
		return false;
	}else if($.trim(_area) == ""){
		alert("请填写项目所在区域！");
		return false;
	}

	var ctx=$("#ctx").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ProjectBasicController/update.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':_proid,'projectName':_name,"projectArea":_area},
		success:function(msg){
			if(msg.success){
				getManageProjectList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function cancelUpdProject() {
	var _ind = $(this).attr("ind");
	$(this).parent().prevAll(".nameTd").html(proList[_ind].projectName);
	$(this).parent().prevAll(".areaTd").html(proList[_ind].projectArea);
	$(this).prev(".saveUpdBtn").text("修改").removeClass("saveUpdBtn").addClass("updBtn");
	$(this).hide();
}
</script>
</head>
<body id="sysManageLayer">
<div id="searchLayer">
	<div id="addProject">
		<a href="javascript:addProRow();"><img src="images/add.png" />&nbsp;&nbsp;新增项目</a>
	</div>
	<input placeholder="请输入项目名" id="projectNameList"/><button type="button" id="btnSerarchList">搜索</button>
</div>
<table id="proTable" border="1"><thead><tr>
	<td width="50" height="34">序号</td>
	<td width="400">项目名称</td>
	<td width="200">区域</td>
	<td>操作</td>
</tr></thead>
<tbody id="proTbody">
</tbody></table>
</body>
</html>