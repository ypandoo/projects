// 导航下标
var naviInd = "2";
// 个人统计信息
var personalInfoObj = {};
// 跟投项目内容列表
var projectList = [];
// 新闻内容列表
var newsList = [];
// 已完成认购列表
var completedList = [];
// 缴款确认列表
var payInList = [];
// 分红明细列表
var bonusList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	$("#isPerson").val("yes");

}

function initListeners(){
	initHeaderListeners();
}

function initPages(){
	getPersonalInfo();
	getProjectInfo();
	getNewsInfo();
	getCompletedInfo();
	getPayInInfo();
	getBonusInfo();
}

function getPersonalInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/getSubscribeSummaryByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"userId":currUser},
		success:function(msg){
			if(msg.success){
				if(msg.dataDto && msg.dataDto.length > 0){
					personalInfoObj = msg.dataDto[0];
					loadPersonalInfo();
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loadPersonalInfo () {
	if(personalInfoObj){
		$("#amountTotalTd").text("￥ "+formatMillions(personalInfoObj.subscribeAmt));
		$("#confirmAmountTd").text("￥ "+formatMillions(personalInfoObj.contributiveAmt));
		$("#leverageAmountTd").text("￥ "+formatMillions(personalInfoObj.leverageAmt));
		$("#bonusAmountTd").text("￥ "+formatMillions(personalInfoObj.bonusAmt));
		$("#proCountTd").html(personalInfoObj.projectCount||0);
	}
}

// 未完成列表
function getProjectInfo(){
	$.ajax({
		type:'post',//可选get
		// url:'../subscribe/queryAllUnCompleteByUserId',
		contentType: "application/json; charset=utf-8",
		url:'../ProjectBasicController/getProjectList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:$.toJSON($("#listform").serializeArray()),
		success:function(msg){
			if(msg.success){
				projectList = msg.dataDto;
				loadProjectInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadProjectInfo(){
	$("#projectList .proList").empty();
	if(projectList && projectList.length > 0){
		var tempHtml = "";
		var tempPayDate;
		var tempSubDate;
		var tempImg = "./images/80_80.png";
		$.each(projectList, function(ind, val){
			tempPayDate = "";
			tempSubDate = "";
			tempImg = "./images/80_80.png";
			if(val.payStartDate){
				tempPayDate = (new Date(val.payStartDate)).format('yyyy-MM-dd');
			}
			if(val.subscribeStartDate){
				tempSubDate = (new Date(val.subscribeStartDate)).format('yyyy-MM-dd');
			}
			if(val.projectImages){
				tempImg = "../images/projectFiles/"+val.projectImages;
			}
			tempHtml +=
				'<div class="listSTY">'+
					'<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%"><tr>'+
						'<td colspan="2" height="90" align="left">'+
							'<a href="projectDetail.jsp?proId='+val.projectId+'"><img src="'+tempImg+'" width="80" height="80" style="border-radius: 40px;"></a>'+
						'</td>'+
					'</tr><tr>'+
						'<td colspan="2" class="proName"><a href="projectDetail.jsp?proId='+val.projectId+'">'+val.projectName+'</a></td>'+
					'</tr><tr>'+
						'<td colspan="2">'+(val.groundPosition||"")+'</td>'+
					'</tr><tr>'+
						'<td>员工跟投总额:</td>'+
						'<td>'+formatMillions(val.followAmount)+' 万元</td>'+
					'</tr><tr>'+
						'<td>认购开始时间:</td>'+
						'<td>'+tempSubDate+'</td>'+
					'</tr><tr>'+
						'<td>付款开始时间:</td>'+
						'<td>'+tempPayDate+'</td>'+
					'</tr></table>'+
				'</div>';
		})
		$("#projectList .proList").html(tempHtml);
	}
}

function getNewsInfo (argument) {
	var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"'+userid+'","pageSize":"'+9+'","projectName":""}',
		success:function(msg){
			if(msg.success){
				newsList=msg.dataDto;
				loadNewsInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadNewsInfo(){
	$("#newsInfo .newsList").empty();
	if(newsList && newsList.length > 0){
		var tempHtml = "";
		$.each(newsList, function(ind, val){
			tempHtml +=
				'<div class="listSTY">'+
					'<a href="./newsDetail.jsp?newsId='+val.newsId+'">'+formatDate(val.releaseDate)+'&nbsp;&nbsp;'+val.title+'</a>'+
				'</div>';
		})
		$("#newsInfo .newsList").html(tempHtml);
	}
}

function getCompletedInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/queryAllCompleteByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"userId":currUser},
		success:function(msg){
			if(msg.success){
				completedList = msg.dataDto;
				loadCompletedInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loadCompletedInfo(){
	$("#compTbody").empty();
	if(completedList && completedList.length > 0){
		var tempHtml = "";
		$.each(completedList, function(ind, val){
			tempHtml +=
				'<tr><td height="25">'+(ind+1)+'</td>'+
					'<td>'+(val.projectName||"")+'</td>'+
					'<td>'+formatMillions(val.contributiveAmount)+'</td>'+
					'<td>'+formatMillions(val.leverageAmount)+'</td>'+
					'<td class="displayNone">'+(val.adjustamt)+'</td>'+
					'<td class="displayNone">'+(val.adjustLeverageAmt)+'</td>'+
					'<td>'+formatMillions(val.contributiveConfirmAmount)+'</td>'+
					'<td>'+formatMillions(val.confirmLeverageAmt)+'</td>'+
					'<td>'+formatMillions(val.confirmationPayment)+'</td>'+
					// '<td width="150">'+formatMillions(val.bonusAmount)+'</td>'+
				'<td>'+formatMillions(val.completeBonusAmount)+'</td></tr>';
		})
		$("#compTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="9" height="70" valign="middle">'+
				'<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#compTbody").html(tempHtml);
	}
}

function getPayInInfo() {
	var _obj = '{'+
			//"projectId":"'+projectId+'",'+
			// '"projectName":"'+_searText+'",'+
			// '"startDate":'+_sDate+','+
			// '"endDate":'+_eDate+','+
			// '"piId":"",'+
			// '"piTimes":0,'+
			// '"subscribeAmt":0,'+
			// '"piDate":"",'+
			// '"piAmt":0,'+
			// '"numberCode":"",'+
			// '"uname":"'+_searText+'",'+
			'"userId":"'+currUser+'",'+
			'"startPage":"'+0+'",'+
			'"endPage":"'+10+'"'+
			'}';
	$.ajax({
		type:'post',//可选get
		url:'../PayInDetailController/selectListByDetail.action',
		contentType: "application/json; charset=utf-8",
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				payInList = msg.dataDto;
				loadPayInInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadPayInInfo(){
	$("#payInTbody").empty();
	if(payInList && payInList.length > 0){
		var tempHtml = "";
		$.each(payInList, function(ind, val){
			tempHtml +=
			'<tr><td width="50" height="35">'+(ind+1)+'</td>'+
			'<td>'+(val.projectName||"")+'</td>'+
			'<td>'+formatMillions(val.subscribeAmt)+'</td>'+
			'<td>'+val.piTimes+'</td>'+
			'<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+formatMillions(val.piAmt)+'</td></tr>';

				// tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
				// '<td>'+val.uname+'</td>'+
				// '<td>'+(val.service||"")+'</td>'+
				// '<td>'+val.subType+'</td>'+
				// '<td>'+formatMillions(val.subscribeAmt)+'</td>'+
				// '<td>'+val.piTimes+'</td>'+
				// '<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
				// '<td>'+formatMillions(val.piAmt)+'</td>'+
				// '<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#payInTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="6" height="70" valign="middle">'+
				'<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#payInTbody").html(tempHtml);
	}
}

function getBonusInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/getBonusDetailList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"startPage":0,
			"endPage":10,
			"startDate":"",
			"endDate":"",
			"projectName":"",
			"userid":"true",
			"projectId":""
		},
		success:function(msg){
			if(msg.success){
				bonusList = msg.dataDto;
				loadBonusInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadBonusInfo(){
	$("#bonusTbody").empty();
	if(bonusList && bonusList.length > 0){
		var tempHtml = "";
		$.each(bonusList, function(ind, val){
			tempHtml +=
				'<tr><td height="25">'+(ind+1)+'</td>'+
					'<td>'+val.projectName+'</td>'+
					'<td>'+formatMillions(val.subscribeAmount)+'</td>'+
					'<td>'+(new Date(val.bonusDate)).format('yyyy-MM-dd')+'</td>'+
					'<td>'+formatMillions(val.bonusAmount)+'</td>'+
					'<td>'+(val.completeSubscribeRecord||"")+'</td>'+
				'</tr>';
		})
		$("#bonusTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="7" height="70" valign="middle">'+
				'<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#bonusTbody").html(tempHtml);
	}
}

function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}