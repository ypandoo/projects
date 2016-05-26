// 导航下标
var naviInd = "2";
var dataList = [];

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

	$("#sDateInp").datetimepicker({format:"Y-m-d",timepicker:false});
	$("#eDateInp").datetimepicker({format:"Y-m-d",timepicker:false});
}

function initPages(){
	getData();
}

function getData(){
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();
	var _projectId = $("#searTextInp").val();
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/getBonusDetailList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"startPage":0,
			"endPage":20,
			"startDate":_sDate,
			"endDate":_eDate,
			"projectName":_searText,
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
        	alert(errorThrown); 
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
				'<td><a href="<?php echo site_url();?>back/projectDetail?projectId='+val.projectId+'">'+val.projectName+'</a></td>'+
				'<td>'+val.subscribeType+'</td>'+
				'<td>'+(val.subscribeAmount || 0)+'</td>'+
				'<td>'+val.bonusTimes+'</td>'+
				'<td>'+(new Date(val.bonusDate)).format('yyyy-MM-dd')+'</td>'+
				'<td>'+(val.bonusAmount || 0)+'</td>'+
				'<td>'+(val.subscribePackageName||"")+'</td>'+
				'<td>'+(val.completeSubscribeRecord||"")+'</td></tr>';
		});
		$("#compTbody").html(tempHtml);
	}
}

function callDialog(){
	$("#dialogBg").show();
	$("#dialogLayer").show();
}

function hideDialog(){
	$("#dialogBg").hide();
	$("#dialogLayer").hide();

}