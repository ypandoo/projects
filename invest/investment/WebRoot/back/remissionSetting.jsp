<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<title>豁免设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="./css/remissionSetting.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="./js/remissionSetting.js"></script>
</head>
<body>
	<div id="mainBody">
		<div id="topPanel">
			<button id="addBtn">新增</button>
		</div>
		<div id="tablePanel" width="100%" border="1">
			<table id="remissionTable">
				<thead>
					<tr>
						<td>序号</td>
						<td>姓名</td>
						<td>部门</td>
						<td>电话</td>
						<td>备注</td>
						<td>豁免次数</td>
						<td>已用豁免次数</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>