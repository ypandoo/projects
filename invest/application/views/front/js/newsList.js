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
	/*$.ajax({
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
	})*/
		var ctx="<?php echo site_url();?>";
	//var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/news/getDynamicNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		//begin=0&count=2&uid=test&projectId=123
		data:{begin: 0,
			count:2,
		    uid: 'test',
		    pojectId: '123'},
		success:function(msg){
			if(msg.success){
				newsList=msg.data;
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

function loadNewsData(){
	$("#news tbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		//{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}
		$.each(newsList, function(ind, val){
		    tempHtml += '<tr class="row"><td><h2><a style="color:red">'+val.FRELEASEDATE+'</a></h2><br>';
		    tempHtml += '<h4 style="font-weight:600"><a href="#">'+val.FTITLE+'</a></h2>';
			tempHtml += '<h4 style=""><a href="#">'+val.FCONTENT +'</a></h4><br></td></tr>';
		})
		$("#news tbody").html(tempHtml);
	}
}

function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}