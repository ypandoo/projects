<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<title>动态新闻列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/newsList.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/newsList.js"></script>
</head>
<body>
<jsp:include page="header.jsp"></jsp:include>
<div id="contentLayer">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 动态新闻列表</div>
	<div id="searchLayer">
		<div class="searSTY floatR">
			<input id="searchText" placeholder="请输入标题或项目进行搜索" type="search" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div>
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="100" height="30">序号</td>
			<td width="300">标题</td>
			<td width="200">创建时间</td>
			<td width="300">所属项目</td>
			<td>作者</td>
		</tr></thead>
		<tbody id="newsTbody">
			<!-- <tr><td height="35">1</td>
			<td><a href="./newsDetail.html">合肥高新项目对账公示</a></td>
			<td>2014-07-19</td>
			<td>合肥高新项目</td>
			<td>张三</td></tr> -->
		</tbody></table>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>