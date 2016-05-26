// 导航下标
var naviInd = "2";
var dataList = [];
var bankList = [];
var tempObj = null;

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

	// 呼出弹出层
	$("#compTbody").on("click",".change", function(){
		tempObj = dataList[$(this).attr("ind")];
		getBankData();
		callDialog();
	});
	// 隐藏弹出层
	$("#dialogLayer .closeSTY").click(function(){
		hideDialog();
	});
	$("#dialogLayer .cancelBtn").click(function(){
		hideDialog();
	});
	$("#dialogLayer .saveBtn").click(function(){
		var _bankId = $(":checkbox[name='bankCk'][checked='checked']").attr("val")||"";
		updateBank(_bankId);
	});
	$("#bankTbody").on("click",":checkbox[name='bankCk']", function(){
		if($(this).attr("checked")){
			$(":checkbox[name='bankCk']").removeAttr("checked");
			$(this).attr("checked","checked");
		}
	})
}

function initPages(){
	getData();
}

function getData(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/queryAllCompleteByUserId.action',
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"userId":currUser},
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
	$("#compTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td height="35">'+(ind+1)+'</td>'+
				'<td><a href="projectDetail.jsp?proId='+val.projectId+'">'+(val.projectName||"")+'</a></td>'+
				'<td>'+ (val.isRemissionSubscribe == true ? "是" : "否") +'</td>'+
				'<td>'+formatDate(val.number)+'</td>'+
				'<td>'+formatMillions(val.contributiveAmount)+'</td>'+
				'<td>'+formatMillions(val.leverageAmount)+'</td>'+
				'<td class="displayNone">'+(val.adjustamt)+'</td>'+
				'<td class="displayNone">'+(val.adjustLeverageAmt)+'</td>'+
				'<td>'+formatMillions(val.contributiveConfirmAmount)+'</td>'+
				// '<td width="120">'+formatMillions(val.bonusAmount)+'</td>'+
				'<td>'+formatMillions(val.confirmLeverageAmt)+'</td>'+
				'<td>'+formatMillions(val.confirmationPayment)+'</td>'+
				'<td>'+formatMillions(val.completeBonusAmount)+'</td>'+
				'<td>'+val.bankNo+'</td>'+
				'<td>'+
					'<a class="change" href="javascript:void(0)" ind="'+ind+'">更换收款账号</a>&nbsp;&nbsp;'+
					// '<a class="view" href="javascript:void(0)">查看</a>'+
			'</td></tr>';
		});
		$("#compTbody").html(tempHtml);
	}
}

function getBankData(){
	bankList = [];
	$.ajax({
		type:'post',//可选get
		url:'../BankController/getBankListByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				bankList = msg.dataDto;
				loadBankData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadBankData(){
	$("#bankTbody").empty();
	if(bankList && bankList.length > 0){
		var tempHtml = "";
		var tempStr = "";
		$.each(bankList, function(ind, val){
			tempStr = tempObj.bankId==val.bankId?'checked="checked"':"";
			tempHtml += '<tr><td height="25"><input type="checkbox" name="bankCk" '+tempStr+' val="'+val.bankId+'" /></td>'+
				'<td>'+val.bankNo+'</td>'+
				'<td>'+val.bankAttribute+'</td>'+
				'<td>'+val.bankName+'</td></tr>';
		});
		$("#bankTbody").html(tempHtml);
	}
}

function updateBank(_bankId){
	var _obj = '{"csrId":"'+tempObj.csrId+'","bankNo":"'+_bankId+'"}'
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/updateBank.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				alert("修改成功!");
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

function callDialog(){
	$("#dialogBg").show();
	$("#dialogLayer").show();
}

function hideDialog(){
	$("#dialogBg").hide();
	$("#dialogLayer").hide();

}

function formatDate(_str){
	if(_str){
		return _str.substring(0,4)+"-"+_str.substring(4,6)+"-"+_str.substring(6,8);
	}else{
		return "";
	}
}