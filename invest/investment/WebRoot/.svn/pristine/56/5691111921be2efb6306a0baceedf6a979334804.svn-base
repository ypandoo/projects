<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>个人信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/personalInfo.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/personalInfo.js"></script>
</head>
<body>
<jsp:include page="header.jsp"></jsp:include>
<div id="contentLayer">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 个人信息</div>
	<div id="titleLayer">
		<div class="titleSTY">个人银行账号列表</div>
		<div class="returnBtn floatR displayNone" id="returnBtn"><a href="javascript:history.back(-1)">返回认购</a></div>
		<div class="titleSTY floatR addBtn" id="addBtn">新增</div>
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="95" height="30">序号</td>
			<td width="315">银行卡号</td>
			<td width="225">开户名</td>
			<td width="225">开户行</td>
			<td>操作</td>
		</tr></thead>
		<tbody id="bankTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td>XXXX XXXX XXXX XXX</td>
			<td>张三</td>
			<td>中国银行</td>
			<td><a href="#">编辑</a>&nbsp;&nbsp;<a href="#">删除</a></td></tr> -->
		</tbody></table>
	</div>
	<div id="personalLayer" style="display:none;">
		<table width="100%"><tr>
			<td align="right" height="40">手机号码：</td>
			<td><input id="" readonly value="138 XXXX XXX" /></td>
			<td align="right">固定号码：</td>
			<td><input id="" readonly value="021-XXXX XXXX" /></td>
		</tr><tr>
			<td align="right" height="40">身份证号：</td>
			<td><input id="" readonly value="430281 XXXXXXXX 4321" /></td>
			<td align="right">邮箱：</td>
			<td><input id="" readonly value="XXX@cifi.com.cn" /></td>
		</tr></table>
	</div>

	<!-- 弹出层 -->
	<div id="dialogBg" style="display:none;"></div>
	<div id="dialogLayer" style="display:none;">
		<div class="title">
			<span class="titleSTY">新增银行账号</span>
			<span class="closeSTY"><img src="./images/close.png" width="100%" height="100%"></span>
		</div>
		<div class="list">
			<div class="dialogTipsSTY">*：此帐号为最终财务汇款帐号，请务必准确填写。<br>建议使用工资卡。银行卡开户名需为认购本人，选择账号为返本/分红账号</div>
			<table width="100%" border="0"><tr>
				<td class="titleTd">银行卡号：</td>
				<td><input id="bankNoInp" /></td>
			</tr><tr>
				<td class="titleTd">开户名：</td>
				<td><input id="bankAttrInp" /></td>
			</tr><tr>
				<td class="titleTd">开户银行：</td>
				<td><input id="bankNameInp" /><br>
				<span class="tipsSTY">请精确到支行,例如：中国建设银行(上海市怒江路支行)</span></td>
			</tr><!-- <tr>
				<td class="titleTd">开户点：</td>
				<td><input id="bankAttrInp" /></td>
			</tr> --></table>
		</div>
		<div class="bottom">
			<div class="cancelBtn"></div>
			<div class="saveBtn"></div>
		</div>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>