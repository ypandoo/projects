<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="plugins/dateFormat.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/jquery.datetimepicker.css"> 
<title>欢迎欢迎</title>
<script type="text/javascript">
$(function(){
	$("#datestr").datetimepicker();

	$("#fuzhi").click(function(){
		var uname=$("#uname").val();
		$.ajax({
			type:'post',//可选get
			url: 'userController/getUserListByName.action',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:{'uname':uname,'startPage':0,'endPage':4},
			success:function(msg){
				if(msg.success){
					alert(msg.dataDto[0].uname);
				}else{
					alert(msg.error);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	alert(errorThrown); 
	        }
		})
	});
});
</script>
</head>
<body>
	<div align="center" style="font-family: sans-serif;">
		<h1>Server is running。。。</h1>
	</div>
	<form id="testfrom" method="post" action="FileUpLoadController/upload.action" enctype="multipart/form-data">
		<input type="file" name="file" value="浏览"/>
		<input type="text" name="projectid" value="065c1c88-f98e-4b29-a6d2-fed41d6fd4f6"/>
		<button id="listbtn">提交</button>
	</form>
		<input type="text"  id="datestr"   />
		<input type="text" name="createTime"  id="createTime"  />
		
		uname<input name="uname" id="uname" value=""/>
		<button id="fuzhi" type="button">查询</button>
	
</body>
</html>
