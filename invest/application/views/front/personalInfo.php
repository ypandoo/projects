<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>个人信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/personalInfo.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url();?>">首页</a> > 个人信息</div>
	<div id="titleLayer">
		<div class="titleSTY">个人银行账号列表</div>
		<div class="returnBtn floatR displayNone" id="returnBtn"><a href="javascript:history.back()">前往认购</a></div>
		<div class="titleSTY floatR addBtn" id="addBtn">新增</div>
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="95" height="30">序号</td>
			<td width="315">银行卡号</td>
			<td width="225">开户名</td>
			<td width="225">开户行</td>
			<td>操作</td>
		</tr></thead>
		<tbody id="bankTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td>XXXX XXXX XXXX XXX</td>
			<td>张三</td>
			<td>中国银行</td>
			<td><a href="#">编辑</a>&nbsp;&nbsp;<a href="#">删除</a></td></tr> -->
		</tbody></table>
	</div>
	<div id="personalLayer" style="display:none;">
		<table width="100%"><tr>
			<td align="right" height="40">手机号码：</td>
			<td><input id="" readonly value="138 XXXX XXX" /></td>
			<td align="right">固定号码：</td>
			<td><input id="" readonly value="021-XXXX XXXX" /></td>
		</tr><tr>
			<td align="right" height="40">身份证号：</td>
			<td><input id="" readonly value="430281 XXXXXXXX 4321" /></td>
			<td align="right">邮箱：</td>
			<td><input id="" readonly value="XXX@cifi.com.cn" /></td>
		</tr></table>
	</div>

	<!-- 弹出层 -->
	<div id="dialogBg" style="display:none;"></div>
	<div id="dialogLayer" style="display:none;">
		<div class="title">
			<span class="titleSTY">新增银行账号</span>
			<span class="closeSTY"><img src="./images/close.png" width="100%" height="100%"></span>
		</div>
		<div class="list">
			<div class="dialogTipsSTY">*：此帐号为最终财务汇款帐号，请务必准确填写。<br>建议使用工资卡。银行卡开户名需为认购本人，选择账号为返本/分红账号</div>
			<table width="100%" border="0"><tr>
				<td class="titleTd">银行卡号：</td>
				<td><input id="bankNoInp" /></td>
			</tr><tr>
				<td class="titleTd">开户名：</td>
				<td><input id="bankAttrInp" /></td>
			</tr><tr>
				<td class="titleTd">开户银行：</td>
				<td><input id="bankNameInp" /><br>
				<span class="tipsSTY">请精确到支行,例如：中国建设银行(温州市XXX路支行)</span></td>
			</tr><!-- <tr>
				<td class="titleTd">开户点：</td>
				<td><input id="bankAttrInp" /></td>
			</tr> --></table>
		</div>
		<div class="bottom">
			<div class="cancelBtn"></div>
			<div class="saveBtn"></div>
		</div>
	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "2";
// 银行账号列表
var dataList = [];
// 操作标识 add:添加账号  edit:编辑账号
var editFlag = "add";
var tempEditObj = null;
var tempProId = null;

var uid = "<?php echo $uid; ?>";

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	tempProId = getReqParam("projectId");
}

function initListeners(){
	initHeaderListeners();

	$("#bankTbody .delBtn").live("click", function(){

		var _ind = $(this).attr("ind");
		tempEditObj = dataList[_ind];
		if(confirm("确认要删除该帐号？")) delBank();
	});

	// 呼出弹出层
	$("#titleLayer #addBtn").click(function(){
		editFlag = "add";
		callDialog();
	});
	$("#bankTbody .editBtn").live("click", function(){
		editFlag = "edit";
		var _ind = $(this).attr("ind");
		tempEditObj = dataList[_ind];
		callDialog();
	})
	// 隐藏弹出层
	$("#dialogLayer .closeSTY").click(function(){
		hideDialog();
	});
	$("#dialogLayer .cancelBtn").click(function(){
		hideDialog();
	});
	$("#dialogLayer .saveBtn").click(function(){
		if(editFlag == "add"){
			addBank();
		}else{
			editBank();
		}
	});
	$("#bankTbody").on("click",":checkbox[name='bankCk']", function(){
		if($(this).attr("checked")){
			$(":checkbox[name='bankCk']").removeAttr("checked");
			$(this).attr("checked","checked");
		}
	})

}

function initPages(){
	if(tempProId){
		$("#returnBtn").removeClass("displayNone").find("a").attr("href","subscribeApply?projectId="+tempProId);
	}
	getData();
}

function getData(){
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:'/BankInfo/getPersonBankInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			uid:uid
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
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadData(){
	$("#bankTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td width="95" height="35">'+(ind+1)+'</td>'+
				'<td width="315">'+val.FBANKNO+'</td>'+
				// '<td width="225">'+val.uName+'</td>'+
				'<td width="225">'+val.FBANKATTRIBUTE+'</td>'+
				'<td width="225">'+val.FNAME+'</td>'+
				'<td><a class="editBtn" ind="'+ind+'" href="javascrip:void(0)">编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
					'<a class="delBtn" ind="'+ind+'" href="javascrip:void(0)">删除</a></td></tr>';
		});
		$("#bankTbody").html(tempHtml);
	}
}

function addBank(){
	var bankNo = $.trim($("#bankNoInp").val());
	var bankName = $.trim($("#bankNameInp").val());
	var bankAttribute = $.trim($("#bankAttrInp").val());


	if(bankNo.length <= 0){
		alert("银行卡号不能为空!");
	}else{
		$.ajax({
			type:'post',
			url:'/BankInfo/addBankInfo',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"FUSERID": uid,
				"FBANKNO": bankNo,
				"FNAME": bankName,
				"FBANKATTRIBUTE": bankAttribute
			},
			success:function(msg){
				if(msg.success){
					alert("添加帐号成功!");
					getData();
					hideDialog();
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

function editBank(){
	var bankNo = $.trim($("#bankNoInp").val());
	var bankName = $.trim($("#bankNameInp").val());
	var bankAttribute = $.trim($("#bankAttrInp").val());

	if(bankNo.length <= 0){
		alert("银行卡号不能为空!");
	}else{
		$.ajax({
			type:'post',
			url:'/BankInfo/updateBankInfo',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{
				"FID": tempEditObj.FID,
				"FBANKNO": bankNo,
				"FNAME": bankName,
				"FBANKATTRIBUTE": bankAttribute
			},
			success:function(msg){
				if(msg.success){
					alert("修改帐号成功!");
					getData();
					hideDialog();
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

function delBank(){
	$.ajax({
		type:'post',
		url:'/BankInfo/deleteBankInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"FID": tempEditObj.FID
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

function callDialog(){
	if("add" == editFlag){
		$("#dialogLayer .titleSTY").text("新增银行账号");
		clearDialog();
	}else{
		$("#dialogLayer .titleSTY").text("编辑银行账号");
		$("#bankNoInp").val(tempEditObj.bankNo);
		$("#bankNameInp").val(tempEditObj.bankName);
		$("#bankAttrInp").val(tempEditObj.bankAttribute);
	}
	$("#dialogBg").show();
	$("#dialogLayer").show();
	$("#bankNoInp").focus();
}

function hideDialog(){
	$("#dialogBg").hide();
	$("#dialogLayer").hide();

}

function initialDialog(){

}

function clearDialog(){
	$("#bankNoInp").val("");
	$("#bankNameInp").val("");
	$("#bankAttrInp").val("");
}
</script>
</body>
</html>