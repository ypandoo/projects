<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>首页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>
<body topmargin="0">
<form id="userForm">
<jsp:include page="header.jsp"></jsp:include>
</form>
<div id="contentLayer">
	<div id="dynamicNewsLayer">
		<div class="title">
			<img src="./images/dynamic_news.png" width="23" height="23" align="top">&nbsp;动态新闻
			<a href="./newsList.jsp" class="moreSTY">更多 》</a>
		</div>
		<div class="list">
			<!-- <div><a href="">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标新安集团钢筋战略采购招标</a></div>
			<div><a href="">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标</a></div>
			<div><a href="">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标</a></div>
			<div><a href="">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标</a></div>
			<div><a href="">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标</a></div> -->
		</div>
	</div>
	<div id="projectListLayer">
		<div class="title">
			<img src="./images/follow_pro.png" width="23" height="23" align="top">&nbsp;跟投项目
			<a href="./projectList.jsp" class="moreSTY">更多 》</a>
		</div>
		<div class="list">
			<!-- <div class="listSTY">
				<div class="proPic"></div>
				<div class="proName"><a href="#">合肥高新项目</a></div>
			</div>
			<div class="listSTY">
				<div class="proPic"></div>
				<div class="proName"><a href="#">合肥高新项目</a></div>
			</div>
			<div class="listSTY">
				<div class="proPic"></div>
				<div class="proName"><a href="#">合肥高新项目</a></div>
			</div> -->
		</div>
	</div>
	<div id="infoViewLayer">
		<div class="title"><img src="./images/view.png" width="23" height="23" align="top">&nbsp;项目跟投概览</div>
		<div class="list">
			<div>项目跟投总数:&nbsp;&nbsp;<span id="projectCount" class="viewSTY">33</span></div>
			<div>认购人次:&nbsp;&nbsp;<span id="peopleCount" class="viewSTY">33</span>&nbsp;人</div>
			<div>认购总额(含杠杆):&nbsp;&nbsp;<span id="subAmount" class="viewSTY">33</span>&nbsp;万元</div>
			<div>分红总额:&nbsp;&nbsp;<span id="bonusAmount" class="viewSTY">33</span>&nbsp;万元</div>
		</div>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>