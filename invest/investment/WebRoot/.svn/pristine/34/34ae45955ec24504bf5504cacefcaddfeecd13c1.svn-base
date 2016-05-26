// 导航下标
var naviInd = "2";
// 银行账号列表
var dataList = [];
// 操作标识 add:添加账号  edit:编辑账号
var editFlag = "add";
var tempEditObj = null;
var tempProId = null;

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
		$("#returnBtn").removeClass("displayNone").find("a").attr("href","subscribeApply.jsp?proId="+tempProId);
	}
	getData();
}

function getData(){
	$.ajax({
		type:'post',//可选get
		url:'../BankController/getBankListByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
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
	$("#bankTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td width="95" height="35">'+(ind+1)+'</td>'+
				'<td width="315">'+val.bankNo+'</td>'+
				// '<td width="225">'+val.uName+'</td>'+
				'<td width="225">'+val.bankAttribute+'</td>'+
				'<td width="225">'+val.bankName+'</td>'+
				'<td><a class="editBtn" ind="'+ind+'" href="javascrip:void(0)">编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
					'<a class="delBtn" ind="'+ind+'" href="javascrip:void(0)">删除</a></td></tr>';
		});
		$("#bankTbody").html(tempHtml);
	}
}

function addBank(){
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
	var bankAttr = $.trim($("#bankAttrInp").val());

	if(bankNo.length <= 0){
		alert("银行卡号不能为空!");
	}else{
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