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
<title>分红列表</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
table{width: 100%;font-size: .8em;}
td{text-align: center;width: 85px;white-space: normal;}
.borderR_STY{border-right: 1px solid lightgray;font-weight: bold;}
.weightB_STY{font-weight: bold;}
.pointD_STY{color: red;}

#bonusList .detailBtn{background: #FFF;font-weight: 100;font-size: .9em;padding: 1em 0em;}

#detailDialog td{text-align: left;padding: 0 .5em;}
#detailDialog .titleTd{background: #F4F9FF; width:6em;height: 30px;text-align: center;}
#dialogHeader{height: 40px;line-height: 40px;text-align: center;}

.ui-content{padding: 0em 1em 1em;}
.ui-listview > .ui-li-static{padding: .7em 0em;}
.ui-page-theme-a .ui-btn.ui-btn-active,
html .ui-bar-a .ui-btn.ui-btn-active,
html .ui-body-a .ui-btn.ui-btn-active,
html body .ui-group-theme-a .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-a.ui-btn-active{border-color: lightgray;/*color: #D94026;*/background: #FFF;text-shadow:none;color: #000;}
</style>
<script type="text/javascript">
var dataList = [];
$(function(){
	$('body').fontFlex(14, 60, 40);

	$("#bonusList").on("click", ".detailBtn", function(){
		resetDetail();
		fillDetail($(this).attr("ind"));
	});

	getData();
});
function getData(){
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/getBonusDetailList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"startPage":0,
			"endPage":999,
			"startDate":"",
			"endDate":"",
			"projectName":"",
			"projectId":"",
			"userid":"true"
		},
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
	// $("#bonusList").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml = 
				'<li data-icon="false"><a class="detailBtn" ind="'+ind+'" href="#detailDialog" data-rel="dialog"><table><tr>'+
					'<td>'+val.projectName+'</td>'+
					'<td>'+(new Date(val.bonusDate)).format('yyyy-MM-dd')+'</td>'+
					'<td>'+val.bonusTimes+'</td>'+
					'<td class="pointD_STY">'+formatMillions(val.bonusAmount)+' (万元)</td>'+
				'</tr></table></a></li>';
			$("#bonusList").append(tempHtml);
		});
		$('#bonusList').listview("refresh");
	}
}
function fillDetail(_ind){
	var _tempObj = dataList[_ind];
	$("#detailDialog #dialogHeader span").remove();
	$("#detailDialog #dialogHeader").append("<span>"+_tempObj.projectName+"</span>");
	$("#detailDialog #subscribeType").text(_tempObj.subscribeType);
	$("#detailDialog #subscribeAmount").text(formatMillions(_tempObj.subscribeAmount));
	$("#detailDialog #bonusTimes").text(_tempObj.bonusTimes);
	$("#detailDialog #bonusDate").text((new Date(_tempObj.bonusDate)).format('yyyy-MM-dd'));
	$("#detailDialog #bonusAmount").text(formatMillions(_tempObj.bonusAmount));
	$("#detailDialog #subscribePackageName").text((_tempObj.subscribePackageName||""));
	$("#detailDialog #completeSubscribeRecord").text((_tempObj.completeSubscribeRecord||""));
}
function resetDetail(){
	$("#detailDialog #subscribeType").text("");
	$("#detailDialog #subscribeAmount").text("");
	$("#detailDialog #bonusTimes").text("");
	$("#detailDialog #bonusDate").text("");
	$("#detailDialog #bonusAmount").text("");
	$("#detailDialog #subscribePackageName").text("");
	$("#detailDialog #completeSubscribeRecord").text("");
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="content">
		<!-- <ul data-role="listview" data-filter="true" data-filter-placeholder="请输入关键字查询">
			<li><table><tr class="weightB_STY">
				<td class="borderR_STY">分红项目</td>
				<td class="borderR_STY">分红日期</td>
				<td class="borderR_STY">分红批次</td>
				<td>分红金额</td>
			</tr></table></li>
		</ul> -->
		<ul id="bonusList" data-role="listview" data-filter="true" data-filter-placeholder="请输入关键字查询">
			<li><table><tr class="weightB_STY">
				<td class="borderR_STY">分红项目</td>
				<td class="borderR_STY">分红日期</td>
				<td class="borderR_STY">分红批次</td>
				<td>分红金额</td>
			</tr></table></li>
			<!-- <li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li>
			<li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li>
			<li><table><tr>
				<td>合肥高新项目</td>
				<td>2014-10-10</td>
				<td>1</td>
				<td class="pointD_STY">5 (万元)</td>
			</tr></table></li> -->
		</ul>
	</div>
</div>
<div data-role="page" id="detailDialog">
	<div data-role="header" id="dialogHeader"></div>
	<div data-role="content">
		<table width="100%" border="0"><tr>
			<td class="titleTd">认购类型:</td>
			<td id="subscribeType"></td>
		</tr><tr>
			<td class="titleTd">平衡额度:<br>(不含杆杠)(万元)</td>
			<td id="subscribeAmount"></td>
		</tr><tr>
			<td class="titleTd">分红批次:</td>
			<td id="bonusTimes"></td>
		</tr><tr>
			<td class="titleTd">分红日期:</td>
			<td id="bonusDate"></td>
		</tr><tr>
			<td class="titleTd">分红金额:<br>(万元)</td>
			<td id="bonusAmount"></td>
		</tr><tr>
			<td class="titleTd">分红账号:</td>
			<td id="subscribePackageName"></td>
		</tr><tr>
			<td class="titleTd">备注:</td>
			<td id="completeSubscribeRecord"></td>
		</tr></table>
	</div>
</div>
</body>
</html>