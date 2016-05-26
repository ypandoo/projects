<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>个人中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/personalCenter.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/personalCenter.js"></script>
</head>
<body>
<form id="listform" >
<jsp:include page="header.jsp"></jsp:include>
<input type="hidden" name="type" value="1">
<input type="hidden" name="releaseStartDate" value="">
<input type="hidden" name="releaseEndDate" value="">
<input type="hidden" name="projectName" value="">
<input type="hidden" name="projectStatus" value="-1">
<!-- <input type="hidden" name="isPerson" value="yes"> -->
</form>
<!-- <div id="header">
	<div id="topLayer">
		<div id="logo"></div>
		<div id="loginer"><a href="#">登录后台</a> | <a href="#">当前登录人</a></div>
		<div id="navigation">
			<ul><li ind="4">帮助中心</li>
				<li ind="3">跟投制度</li>
				<li ind="2" class="focusOn">个人中心</li>
				<li ind="1">跟投项目信息</li>
				<li ind="0">首页</li></ul>
		</div>
		<ul id="personalSelector" style="display:none;">
			<li ind="5">我要认购</li>
			<li ind="6">未完成认购</li>
			<li ind="7">已完成认购</li>
			<li ind="8">分红明细</li>
			<li ind="9">个人信息</li>
		</ul>
	</div>
</div> -->
<div id="contentLayer">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 个人中心</div>
	<div id="personalInfo">
		<table class="infoTable" border="0" cellpadding="0" cellspacing="0"><tr>
			<td width="200">个人跟投总额(万元)</td>
			<td width="200">个人出资总额(万元)</td>
			<td width="200">杠杆认购总额(万元)</td>
			<td width="200">分红总额(万元)</td>
			<td>认购项目数量</td>
		</tr><tr class="valSTY">
			<td id="amountTotalTd">￥ 0</td>
			<td id="confirmAmountTd">￥ 0</td>
			<td id="leverageAmountTd">￥ 0</td>
			<td id="bonusAmountTd">￥ 0</td>
			<td id="proCountTd">0</td>
		</tr></table>
	</div>
	<div id="projectInfo">
		<div id="projectList">
			<div class="proTitle">
				<span class="titleSTY">未完成跟投项目</span><a class="moreSTY" href="projectList.jsp?isPerson=yes">更多 》</a>
			</div>
			<div class="proList">
				<!-- <div class="listSTY">
					<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%"><tr>
						<td colspan="2" height="90" align="left">
							<img src="./images/80_80.png" width="80" height="80">
						</td>
					</tr><tr>
						<td colspan="2" class="proName"><a href="#">合肥高新项目</a></td>
					</tr><tr>
						<td colspan="2">合肥地产</td>
					</tr><tr>
						<td>员工跟投总额:</td>
						<td>4,300 万元</td>
					</tr><tr>
						<td>付款开始时间:</td>
						<td>2014-07-19 00:00</td>
					</tr><tr>
						<td>认购开始时间:</td>
						<td>2014-07-19 00:00</td>
					</tr></table>
				</div> -->
			</div>
		</div>
		<div id="newsInfo">
			<div class="newsTitle"><span class="titleSTY">动态新闻</span><a class="moreSTY" href="newsList.jsp">更多 》</a></div>
			<div class="newsList">
				<!-- <div class="listSTY">
					<a href="#">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标新安集团钢筋战略采购招标</a>
				</div> -->
			</div>
		</div>
	</div>
	<div id="completedInfo">
		<div class="compTitle">
			<span class="titleSTY">已完成认购</span><a class="moreSTY" href="completed.jsp">更多 》</a>
		</div>
		<div class="compList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td rowspan="2" width="40" height="34">序号</td>
				<td rowspan="2" width="150">跟投项目</td>
				<td colspan="2">认购额度</td>
				<td colspan="2" class="displayNone">调整额度</td>
				<td colspan="2">平衡额度</td>
				<td rowspan="2">缴款确认金额(万元)</td>
				<td rowspan="2">已分红总额(万元)</td>
			</tr><tr>
				<td width="140">出资金额(万元)</td>
				<td width="140">杠杆金额(万元)</td>
				<td width="110" class="displayNone">出资金额(万元)</td>
				<td width="110" class="displayNone">杠杆金额(万元)</td>
				<td width="140">出资金额(万元)</td>
				<td width="140">杠杆金额(万元)</td>
			</tr></thead>
			<tbody id="compTbody">
				<!-- <tr><td colspan="9" height="70" valign="middle">
						<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据
				</td></tr> -->
				<!-- <tr><td width="60" height="25">1</td>
					<td width="180">跟投项目</td>
					<td width="150">300,000.00</td>
					<td width="150">1,200,000.00</td>
					<td width="150">1,200,000.00</td>
					<td width="150">980,000.00</td>
				<td>100,000.00</td></tr> -->
			</tbody></table>
		</div>
	</div>
	<div id="payInInfo">
		<div class="payInTitle">
			<span class="titleSTY">缴款确认</span><a class="moreSTY" href="payInDetail.jsp">更多 》</a>
		</div>
		<div class="payInList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td width="60" height="34">序号</td>
				<td width="280">跟投项目</td>
				<td width="170">平衡额度<br>(不含杠杆)(万元)</td>
				<td>缴款批次</td>
				<td width="170">缴款日期</td>
				<td width="150">缴款金额<br>(万元)</td>
			</tr></thead>
			<tbody id="payInTbody">
				<tr><td colspan="6" height="70" valign="middle">
						<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据
				</td></tr>
				<!-- <tr>
					<td height="25">1</td>
					<td>合肥高新项目</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
				</tr> -->
			</tbody></table>
		</div>
	</div>
	<div id="bonusInfo">
		<div class="bonusTitle">
			<span class="titleSTY">分红明细</span><a class="moreSTY" href="bonusDetail.jsp">更多 》</a>
		</div>
		<div class="bonusList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td width="60" height="34">序号</td>
				<td width="280">跟投项目</td>
				<td width="170">平衡额度<br>(含杠杆)(万元)</td>
				<td width="170">分红日期</td>
				<td width="150">分红金额<br>(万元)</td>
				<td>备注</td>
			</tr></thead>
			<tbody id="bonusTbody">
				<tr><td colspan="7" height="70" valign="middle">
						<img src="./images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据
				</td></tr>
				<!-- <tr>
					<td height="25">1</td>
					<td>合肥高新项目</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
					<td>980,000.00</td>
				</tr> -->
			</tbody></table>
		</div>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>