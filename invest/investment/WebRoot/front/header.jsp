<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	String loginId = (String)request.getSession().getAttribute("loginId");
	String loginName = (String)request.getSession().getAttribute("loginName");
	String accountName = (String)request.getSession().getAttribute("accountName");
	// System.out.println("wyyyyyyy --- loginId:::"+loginId);
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<input type="hidden" id="ctx" value="${pageContext.request.contextPath}">
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<input id="accountnameInp" type="hidden" value="${accountName}">
<input type="hidden" name="userid" id="userid" value="张三id">
<input type="hidden" name="isPerson" id="isPerson" value="">  <!-- 个人中心查询标识 -->

	<div id="header">
	<div id="topLayer">
		<div id="logo"></div>
		<div id="loginer">
			<a id="showLogin" href="javascript:void(0);">当前登录:${loginName}</a>
			| <a id="loginBack" href="javascript:void(0);">登录后台</a>
			| <a id="resetLogin" href="javascript:void(0);">退出登录</a>
		</div>
		<div id="navigation">
			<ul><li ind="4">帮助中心</li>
				<li ind="3">跟投制度</li>
				<li ind="2">个人中心</li>
				<li ind="1">跟投项目信息</li>
				<li ind="0">首页</li></ul>
		</div>
	</div>
<ul id="personalSelector" style="display:none;">
	<li ind="5">我要认购</li>
	<li ind="6">未完成认购</li>
	<li ind="7">已完成认购</li>
	<li ind="12">缴款确认</li>
	<li ind="8">分红明细</li>
	<li ind="9">个人信息</li>
</ul>
<ul id="projectSelector" style="display:none">
	<li ind="10">项目信息</li>
	<li ind="11">动态新闻</li>
</ul>
</div>
</body>
</html>