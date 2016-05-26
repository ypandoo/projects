// 导航下标
var naviInd = "1";
var dataList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams (argument) {
	// body...
}

function initListeners (argument) {
	initHeaderListeners();

	$("#searchBtn").click(getNewsList);
}

function initPages (argument) {
	getNewsList();
}

function getNewsList(){
	var _searText = $("#searchText").val();
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"","pageSize":"'+999+'","projectName":"'+_searText+'"}',
		success:function(msg){
			if(msg.success){
				dataList=msg.dataDto;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadNewsData(){
	$("#newsTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
			'<td><a href="./newsDetail.jsp?newsId='+val.newsId+'">'+val.title+'</a></td>'+
			'<td>'+formatDate(val.releaseDate)+'</td>'+
			'<td>'+val.projectName+'</td>'+
			'<td>'+(val.authorName||"")+'</td></tr>';
		})
		$("#newsTbody").html(tempHtml);
	}
}

function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}