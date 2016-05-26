<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	String loginId = (String)request.getSession().getAttribute("loginId");
	String loginName = (String)request.getSession().getAttribute("loginName");
	// System.out.println("wyyyyyyy --- loginId:::"+loginId);
%>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script type="text/javascript">
$(function(){
	$("#header #logo").click(function(){
		location.href="index.jsp";
	});
	$("#resetLogin").click(loginOut);
});
function loginOut(){
	$.ajax({
		type:'post',//可选get
		url:'../userController/loginOut.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				location.href = "../front/login.jsp"
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}
</script>
</head>
<body>
<div id="header">
	<div id="topLayer">
		<div id="logo"></div>
		<div id="loginer">
			<a href="javascript:void(0);">当前登录:${loginName}</a>
			| <a href="../front/index.jsp">返回前台</a>
			| <a id="resetLogin" href="javascript:void(0);">退出登录</a>
		</div>
	</div>
	<input id="accountnameInp" type="hidden" value="${accountName}">
	<input type="hidden" name="userid" id="userid" value="张三的ididid"/>
	<input type="hidden" id="ctx" value="${pageContext.request.contextPath}">
	<input type="hidden" id="projectid" value="<%=request.getParameter("projectId") %>">
</div>
</body>
</html>