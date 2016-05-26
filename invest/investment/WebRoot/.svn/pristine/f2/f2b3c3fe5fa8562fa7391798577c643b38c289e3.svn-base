// 导航下标
var naviInd = "1";
var newsInfo = null;
var newsId = null;
var projectId = null;

$(function(){
	initNewsParams();
	initNewsListeners();
	initNewsPages();
});

function initNewsParams (argument) {
	newsId = getReqParam("newsId");
	projectId = getReqParam("projectId");
}
function initNewsListeners (argument) {
	initHeaderListeners();
}

function initNewsPages (argument) {
	getNewsDetail();
}

function getNewsDetail(){
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsDetail.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'newsId':newsId
		},
		success:function(msg){
			if(msg.success){
				newsInfo = msg.pagerDTO;
			}else{
				alert(msg.error);
			}
			loadNewsInfo();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert(errorThrown); 
		}
	});
}

function loadNewsInfo () {
	if(newsInfo){
		$("#newsTitle").text(newsInfo.title);
		$("#newsProperty").html('<span>发布人：'+newsInfo.authorName+'</span><span>'+(new Date(newsInfo.releaseDate)).format('yyyy-MM-dd')+'</span><span>'+(newsInfo.projectName||"")+'</span>');
		$("#content").html(newsInfo.content);

		if(newsInfo.projectId){
			projectId = newsInfo.projectId;
		}
	}
	$("#returnDynList").attr("href","projectDetail.jsp?tabInd=news&proId="+projectId)
}