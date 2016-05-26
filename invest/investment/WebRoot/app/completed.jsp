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
<title>已完成列表</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
table{border: 1px solid lightgray;border-spacing: 1px;border-collapse: collapse;width: 100%;border-radius: 3px;height: 160px;font-size: .9em;}
td{text-align: center;vertical-align: middle;padding: .7em 0em;}
.row_STY{background: #F4F9FF;}

.ui-listview > .ui-li-static{padding: .7em .5em;}
</style>
<script type="text/javascript">
var currUser = "";
var dataList = [];
$(function(){
	currUser = $("#loginInp").val();
	$('body').fontFlex(14, 60, 40);

	getData();
});
function getData(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/queryAllCompleteByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"userId":currUser},
		success:function(msg){
			if(msg.success){
				dataList = msg.dataDto;
				loadData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}
function loadData(){
	$("#proList").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml += 
				'<li><table border="1"><tr>'+
					'<td colspan="3"><h1>'+val.projectName+'</h1></td>'+
				'</tr><tr>'+
					'<td rowspan="2">认购额度</td>'+
					'<td>出资金额</td>'+
					'<td>'+formatMillions(val.contributiveAmount)+' (万元)</td>'+
				'</tr><tr class="row_STY">'+
					'<td>杆杠金额</td>'+
					'<td>'+formatMillions(val.leverageAmount)+' (万元)</td>'+
				'</tr><tr>'+
					'<td rowspan="2">确认额度</td>'+
					'<td>出资金额</td>'+
					'<td>'+formatMillions(val.contributiveConfirmAmount)+' (万元)</td>'+
				'</tr><tr class="row_STY">'+
					'<td>杆杠金额</td>'+
					'<td>'+formatMillions(val.confirmLeverageAmt)+' (万元)</td>'+
				'</tr>' +
				'<tr>'+
					'<td rowspan="3">其他</td>'+
					'<td>缴款确认金额</td>'+
					'<td>'+formatMillions(val.confirmationPayment)+' (万元)</td>'+
				'</tr>' +
				'<tr class="row_STY">'+
					'<td>已分红总额</td>'+
					'<td>'+formatMillions(val.completeBonusAmount)+' (万元)</td>'+
				'</tr>' +
				'<tr>'+
				'<td>是否豁免认购</td>'+
				'<td>'+ (val.isRemissionSubscribe == true ? "是" : "否") +'</td>'+
			'</tr>'+
					'</table></li>';
		});
		$("#proList").html(tempHtml);
		$('#proList').listview("refresh");
	}
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="content">
		<ul id="proList" data-role="listview" data-filter="true" data-filter-placeholder="请输入关键字查询">
			<!-- <li><table border="1"><tr>
				<td colspan="3"><h1>合肥高新项目</h1></td>
			</tr><tr>
				<td rowspan="2">认购额度</td>
				<td>出资金额</td>
				<td>20 (万元)</td>
			</tr><tr class="row_STY">
				<td>杆杠金额</td>
				<td>20 (万元)</td>
			</tr><tr>
				<td rowspan="2">确认额度</td>
				<td>出资金额</td>
				<td>20 (万元)</td>
			</tr><tr class="row_STY">
				<td>杆杠金额</td>
				<td>20 (万元)</td>
			</tr><tr>
				<td></td>
				<td>已分红总额</td>
				<td>200 (万元)</td>
			</tr></table></li> -->
		</ul>
	</div>
</div>
</body>
</html>