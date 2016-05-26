<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>缴款确认</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- <link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css"> -->
<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/payInDetail.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script> -->
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/payInDetail.js"></script>
</head>
<body>
<jsp:include page="header.jsp"></jsp:include>
<div id="contentLayer">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 缴款确认</div>
	<div id="searchLayer">
		<div class="searSTY dimissionSTY displayNone">
			<button id="dimissionBtn">离职退款</button>
		</div>
		<div class="searSTY floatR">
			<input id="searTextInp" type="search" placeholder="请输入项目名查询" value="" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div>
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="80" height="30">序号</td>
			<td width="240">跟投项目</td>
			<td width="130">认购类型</td>
			<td width="150">平衡额度<br>(不含杠杆)(万元)</td>
			<td width="120">缴款批次</td>
			<td width="170">缴款日期</td>
			<td>缴款金额<br>(万元)</td>
		</tr></thead>
		<tbody id="payInTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td>合肥高新项目</td>
			<td>城市强投包</td>
			<td>20</td>
			<td>2</td>
			<td>2014-07-29</td>
			<td>50</td></tr> -->
		</tbody></table>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>