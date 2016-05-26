<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
	String loginId = (String)request.getSession().getAttribute("loginId");
	String loginName = (String)request.getSession().getAttribute("loginName");
%>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<title>新闻列表</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
#newsList .dateSTY{color:#A3A3A3; font-size: .7em;}

.ui-input-search.ui-input-has-clear .ui-btn.ui-input-clear, .ui-input-text.ui-input-has-clear .ui-btn.ui-input-clear{padding: .8em 0.3em;margin: -1.5em .0em 0;}
.ui-btn{padding:1.1em 2.0em 1.1em 1em;}
.ui-page-theme-a .ui-btn:hover, html .ui-bar-a .ui-btn:hover, html .ui-body-a .ui-btn:hover, html body .ui-group-theme-a .ui-btn:hover, html head + body .ui-btn.ui-btn-a:hover{color: #000;text-shadow:none;background: #FFF;}
.ui-listview > .ui-li-has-thumb > .ui-btn, .ui-listview > .ui-li-static.ui-li-has-thumb{min-height: 6em;padding-left: 6.5em;}
.ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head + body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head + body .ui-btn.ui-btn-a:visited{background-color: #FFFFFF;font-size: 1em;font-weight: 100;text-shadow:none;border-color: lightgray;}

.ui-page-theme-a .ui-btn.ui-btn-active,
html .ui-bar-a .ui-btn.ui-btn-active,
html .ui-body-a .ui-btn.ui-btn-active,
html body .ui-group-theme-a .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-a.ui-btn-active{border-color: lightgray;}
</style>

<script type="text/javascript">
var newsList = null;

$(function(){
	currUser = $("#loginInp").val();
	$('body').fontFlex(14, 60, 40);

	getNewsList();});
function getNewsList(){
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"","pageSize":"'+999+'","projectName":""}',
		success:function(msg){
			if(msg.success){
				newsList = msg.dataDto;
			}else{
				alert(msg.error);
			}
			loadNewsList();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}
function loadNewsList() {
	if(newsList && newsList.length > 0){
		var tempHtml = "";
		$.each(newsList, function(ind, val){
			tempHtml += '<li><a href="./newsDetail.jsp?newsId='+val.newsId+'" rel="external"><span class="dateSTY">'+formatDate(val.releaseDate)+'</span>&nbsp;'+val.title+'</a></li>';
		})
		$("#newsList").html(tempHtml);
		$("#newsList").listview('refresh');
	}
}
function formatDate(ss){
	var dt=new Date(ss);
	var m = dt.getMonth()+1;
	var d = dt.getDate();
	var dtstr=dt.getFullYear()+"-"+(m<10?"0"+m:m)+"-"+(d<10?"0"+d:d);
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="content">
		<ul id="newsList" data-role="listview" data-inset="false" data-filter="true" data-filter-placeholder="请输入关键字搜索">
			<li><a href="">2014-10-10  项目a</a></li>
			<li><a href="">2014-10-10  项目a</a></li>
			<li><a href="">2014-10-10  项目a</a></li>
		</ul>
	</div>
</div>
</body>
</html>