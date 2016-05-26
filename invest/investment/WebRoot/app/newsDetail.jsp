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
<meta name="format-detection" content="telephone=no" />
<title>新闻动态</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
#header{border-bottom:1px solid lightgray;}
#header #newsTitle{text-align: left;font-size: .9em;font-weight: bold;margin: .5em;}
#header #newsProperty{width: 100%;margin: .5em auto;}
#header #newsProperty span{margin: 0 .3em;font-size: .8em;color: #AEADAD;}
#liner{border-bottom: 2px solid #e8e8e8;}
#content{width: 90%;margin: 10px auto;}
#content pre{line-height: 30px;font-size: 1.0em;}
#content a{word-break: break-all;}
</style>

<script type="text/javascript">
var newsId = "";
var newsInfo = null;

$(function(){
	currUser = $("#loginInp").val();
	$('body').fontFlex(14, 60, 40);

	newsId = getReqParam("newsId");
	getNewsInfo();
});
function getNewsInfo(){
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
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}
function loadNewsInfo () {
	if(newsInfo){
		$("#newsTitle").text(newsInfo.title);
		$("#newsProperty").html('<span>'+newsInfo.authorName+'</span><span>发布于'+(new Date(newsInfo.releaseDate)).format('yyyy-MM-dd')+'</span><span>'+(newsInfo.projectName||"")+'</span>');
		$("#content").html(newsInfo.content);

		if(newsInfo.projectId){
			projectId = newsInfo.projectId;
		}
	}
	$("#returnDynList").attr("href","projectDetail.jsp?tabInd=news&proId="+projectId)
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div id="header" data-role="header" data-position="fixed">
		<div id="newsTitle">上海高新项目</div>
		<div id="newsProperty">2014-10-10 admin</div>
	</div>
	<div id="content"></div>
</div>
</body>
</html>