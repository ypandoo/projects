// 导航下标
var naviInd = "0";
// 新闻列表内容
var newsList = [];
// 项目列表内容
var projectList = [];
// 系统概览内容
var systemInfo = {};

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){

	systemInfo = {
		proCount: "0",
		peopleCount: "0",
		subAmount: "0",
		bonusAmount: "0"
	};
}

function initListeners(){
	initHeaderListeners();
}

function initPages(){
	getProjectData();
	getNewsData();
	getSysInfo();
}
function getNewsData(){
	var ctx=$("#ctx").val();
	var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"'+userid+'","pageSize":"'+5+'","projectName":""}',
		success:function(msg){
			if(msg.success){
				newsList=msg.dataDto;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getProjectData(){
	var ctx=$("#ctx").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ProjectBasicController/getProjectList.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:$.toJSON($("#userForm").serializeArray()),
		success:function(msg){
			if(msg.success){
				projectList=msg.dataDto;
				loadProjectData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getSysInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/getSubscribeSummary.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				if(msg.dataDto && msg.dataDto.length > 0){
					systemInfo = msg.dataDto[0];
					loadSysInfo();
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
function loadSysInfo(){
	$("#projectCount").html(systemInfo.projectCount||0);
	$("#peopleCount").html(systemInfo.personCount||0);
	$("#subAmount").html(formatMillions(systemInfo.subscribeAmt));
	$("#bonusAmount").html((systemInfo.bonusAmt?systemInfo.bonusAmt/10000:0));
}
function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
function loadNewsData(){
	var tempHtml = "";
	// newsList = [{}];  // 测试数据
	$.each(newsList, function(ind, val){
		tempHtml += '<div><a href="./newsDetail.jsp?newsId='+val.newsId+'">'+formatDate(val.releaseDate)+'&nbsp;&nbsp;'+val.title+'</a></div>';
		// tempHtml += '<div><a href="./newsDetail.jsp">2014-08-14&nbsp;&nbsp;关于《合肥高新项目跟投方案》公示及跟投申报的通知</a></div>';
	})
	$("#dynamicNewsLayer .list").html(tempHtml);
}
function loadProjectData(){
	var tempHtml = "";
	var tempImg = "images/254_142.png";
	var leng = 0;
	if(projectList && projectList.length > 3){
		leng = 3;
	}else{
		leng = projectList.length;
	}
	// $.each(projectList, function(ind, val){
	for(var ind=0;ind<leng;ind++){
		var val = projectList[ind];
		tempImg = "images/254_142.png";
		if(val.projectImages){
			tempImg = "../images/projectFiles/"+val.projectImages;
		}
		tempHtml += 
			'<div class="listSTY">'+
				'<div class="proPic"><a href="./projectDetail.jsp?proId='+val.projectId+'"><img width="100%" height="100%" src="'+tempImg+'" /></a></div>'+
				'<div class="proName"><a href="./projectDetail.jsp?proId='+val.projectId+'">'+val.projectName+'</a></div>'+
			'</div>';
	}
	// })
	$("#projectListLayer .list").html(tempHtml);
}