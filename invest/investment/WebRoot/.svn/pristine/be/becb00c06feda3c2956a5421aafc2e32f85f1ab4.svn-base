<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 认购确认</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/ajaxfileupload.js"></script>

<style type="text/css">
body{font-size: 12px;}
#rightLayer #searchLayer #importSubscribeBtn, #rightLayer #searchLayer #exportSubscribeBtn{float: left;margin-right:10px;}
#rightLayer #searchLayer{text-align: right;margin:0px auto 10px;overflow: hidden;position: relative;}
#rightLayer #searchLayer input{width: 200px;height: 25px;padding:0px 5px;}
#rightLayer #confirmTable{border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;}
#rightLayer #confirmTable thead{background: url(images/thead_bg.png);}
#rightLayer #confirmTable td{text-align: center;border: 1px solid #e8e8e8;}
#rightLayer #confirmTable input{width: 60px;height: 25px;}
</style>

<script type="text/javascript">
var confirmList = [];
$(function(){
	getConfirmData();

	$("#importSubscribeBtn").click(function(){
		$("#subFileUp").click();
	});
	$("#subFileUp").live("change", importSubFunc);
	$("#exportSubscribeBtn").click(function(){
		location.href = "../subscribe/callSubscribeExport.action?projectId="+projectId+"&subscribeIds=";
	});
	$("#keyForce").click(keyForceFunc);

	$("#confirmTbody").on("click",".saveBtn",function(){
		var _ind = $(this).attr("ind");
		var _adVal = $("#adjustInp_"+_ind).val();
		var _adLevVal = $("#adjustLevInp_"+_ind).val();
		var _cfmVal = $("#confirmInp_"+_ind).val();
		var _cfmLevVal = $("#confirmLevInp_"+_ind).val();

		$.ajax({
			type:'post',//可选get
			url:'../subscribe/saveAdjAndConfirmtSubscribe.action',
			// contentType:"application/json",
			dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"csrid": confirmList[_ind].csrId,
				"AdjustSubAmt":parseFloat(_adVal)*10000,
				"AdjustLevelAmt":parseFloat(_adLevVal)*10000,
				"confirmSubAmt": parseFloat(_cfmVal)*10000,
				"confirmLevelAmt": parseFloat(_cfmLevVal)*10000
			},
			success:function(msg){
				if(msg.success){
					alert("认购金额调整成功！");
					getConfirmData();
				}else{
					alert(msg.error);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
	        }
		})
	});
	$("#confirmTbody").on("click",".delBtn",function(){
		if(confirm("确认要删除该记录？")){
			var _ind = $(this).attr("ind");
			$.ajax({
				type:'post',//可选get
				url:'../subscribe/deleteByPrimaryKey.action',
				// contentType:"application/json",
				dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
				data:{
					"crsId": confirmList[_ind].csrId,
				},
				success:function(msg){
					if(msg.success){
						alert("删除成功！");
						getConfirmData();
					}else{
						alert(msg.error);
					}
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
		        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		        }
			})
		}
	});
});
function getConfirmData (argument) {
	confirmList = [];
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/queryAllUnComplete.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"projectId":projectId,
			"startPage":0,
			"endPage":9999,
			"random": Math.random() //随机参数，防止IE缓存ajax请求
		},
		success:function(msg){
			if(msg.success){
				confirmList=msg.dataDto;
				loadConfirmList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadConfirmList (argument) {
	$("#confirmTbody").empty();
	if(confirmList && confirmList.length > 0){
		var tempHtml = "";
		$.each(confirmList, function(ind,val){
			tempHtml += 
			'<tr><td>'+(ind+1)+'</td>'+
				'<td>'+val.uName+'</td>'+
				'<td>'+val.service+'</td>'+
				'<td>'+val.subType+'</td>'+
				'<td>'+ (val.isRemissionSubscribe == true ? "是" : "否")+'</td>'+
				'<td'+ (val.dimission == true ? " class=marked>是" : ">否")+'</td>'+
				'<td>'+formatMillions(val.contributiveAmount)+'</td>'+
				'<td>'+formatMillions(val.leverageAmount)+'</td>'+
				'<td class="displayNone"><input id="adjustInp_'+ind+'" value="'+formatMillions(val.adjustamt)+'" /></td>'+
				'<td class="displayNone"><input id="adjustLevInp_'+ind+'" value="'+formatMillions(val.adjustLeverageAmt)+'" /></td>'+
				'<td><input id="confirmInp_'+ind+'" value="'+formatMillions(val.contributiveConfirmAmount)+'" /></td>'+
				'<td><input id="confirmLevInp_'+ind+'" value="'+formatMillions(val.confirmLeverageAmt)+'" /></td>'+
				'<td>'+val.bankNo+'</td>'+
				'<td><a class="saveBtn" ind="'+ind+'" href="javascript:void(0)">保存</a>'+
				// '&nbsp;&nbsp;<a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
				'</td></tr>';
		});
		$("#confirmTbody").html(tempHtml);
	}
}
function importSubFunc() {
	$.ajaxFileUpload({
		url: '../subscribe/callSubscribeImport.action', //用于文件上传的服务器端请求地址
		secureuri: false, //是否需要安全协议，一般设置为false
		cache:false,
		fileElementId: 'subFileUp', //文件上传域的ID
		dataType:'text', //返回值类型 一般设置为json
		success: function (data, status){  //服务器成功响应处理函数
			//data = data.replace(/^<*>$/, "");
			data = data.replace(/<[^>]+>/g,"")
			data = eval('(' + data + ')'); 
			if(data && data.success){
				alert("导入成功!");
				getConfirmData();
			}else{
				alert(data.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert(e);
		}
	})
}
function keyForceFunc(){
	if(confirm("对仍然未进行跟投操作的员工将进行最低额度强制认购,\n\n确定要这么做吗？")){
		$.ajax({
			type:'post',//可选get
			url:'../ForceFollowController/keyForceList.action',
			// contentType:"application/json",
			dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"projectId": projectId,
			},
			success:function(msg){
				if(msg.success){
					alert("添加强制跟投记录成功！");
					getConfirmData();
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
</script>
</head>
<body id="rightLayer">
<div id="searchLayer">
	<button id="exportSubscribeBtn">导出认购核准模板</button>
	<input type="file" id="subFileUp" name="subFileUp" style="left:12em;top:0px;width:80px;">
	<button id="importSubscribeBtn">导入核准数据</button>
	<button id="keyForce">一键强制跟投</button>
	<!-- <input placeholder="请输入项目名或认购人" /><button id="searchTextBtn">搜索</button> -->
</div>
<table id="confirmTable" border="1" width="100%">
	<thead>
		<tr>
			<td rowspan="2" height="34" width="40">序号</td>
			<td rowspan="2" width="80">认购人</td>
			<td rowspan="2" width="90">部门</td>
			<td rowspan="2" width="80">认购类型</td>
			<td rowspan="2" width="70">豁免认购</td>
			<td rowspan="2" width="70">是否离职</td>
			<td colspan="2">认购额度(万元)</td>
			<td colspan="2" class="displayNone">调整额度(万元)</td>
			<td colspan="2">平衡额度(万元)</td>
			<td rowspan="2">分红账号</td>
			<td rowspan="2" width="60">操作</td>
		</tr>
	<tr>
		<td width="85">出资金额</td>
		<td width="85">杠杆金额</td>
		<td width="95" class="displayNone">出资金额</td>
		<td width="95" class="displayNone">杠杆金额</td>
		<td width="85">出资金额</td>
		<td width="85">杠杆金额</td>
	</tr>
</thead>
<tbody id="confirmTbody">
	<!-- <tr><td>1</td>
		<td>张三</td>
		<td>合肥高新项目</td>
		<td>4</td>
		<td>4</td>
		<td><input value="4,000.00" /></td>
		<td><input value="4,000.00" /></td>
		<td><input value="4,000.00" /></td>
		<td><input value="4,000.00" /></td>
		<td>XXXX XXXX XXXX XXX</td>
		<td><a href="javascript:void(0)">保存</a></td></tr> -->
</tbody></table>
</body>
</html>