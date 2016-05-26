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
<title>项目详细</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script> -->
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquerymobile/1.4.2/jquery.mobile.min.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
ul{border: none;}
li{border: none;text-align: center;background: #FFF;}
.borderR_STY{border-right: 1px solid lightgray;}
#posIcon{height: 3px;position: absolute;bottom: 0px;z-index: 10;background: #3388cc;width: 33%;left: 0%;}

#newsList .newsSTY{background: #FFF;font-weight: 100;font-size: .9em;}
#newsList .dateSTY{color:#A3A3A3; font-size: .7em;}

.content table{border-collapse: collapse;border:1px solid lightgray;}
.content table td{font-size: .8em;padding: .5em 1em;vertical-align: top;}
.content table .titleTd{color: #797979;background: #EDEDFD;width: 40%;text-align: center;}
.content .fontSTY{font-size: .8em;}

.ui-header{border:none;border-bottom: 1px solid lightgray;}
.ui-navbar ul{padding: 10px 0;background: #FFF;}

/*.ui-page-theme-a .ui-bar-inherit{background: #FFF;}*/
.ui-controlgroup{text-align: center;}
.ui-page-theme-b .ui-btn, html .ui-bar-b .ui-btn, html .ui-body-b .ui-btn, html body .ui-group-theme-b .ui-btn, html head + body .ui-btn.ui-btn-b, .ui-page-theme-b .ui-btn:visited, html .ui-bar-b .ui-btn:visited, html .ui-body-b .ui-btn:visited, html body .ui-group-theme-b .ui-btn:visited, html head + body .ui-btn.ui-btn-b:visited{background: #FFFFFF;border: none;font-size: .8em;font-weight: 100;text-shadow:none;color: #000;}
.ui-page-theme-b .ui-btn.ui-btn-active, html .ui-bar-b .ui-btn.ui-btn-active, html .ui-body-b .ui-btn.ui-btn-active, html body .ui-group-theme-b .ui-btn.ui-btn-active, html head + body .ui-btn.ui-btn-b.ui-btn-active, .ui-page-theme-b .ui-checkbox-on:after, html .ui-bar-b .ui-checkbox-on:after, html .ui-body-b .ui-checkbox-on:after, html body .ui-group-theme-b .ui-checkbox-on:after, .ui-btn.ui-checkbox-on.ui-btn-b:after, .ui-page-theme-b .ui-flipswitch-active, html .ui-bar-b .ui-flipswitch-active, html .ui-body-b .ui-flipswitch-active, html body .ui-group-theme-b .ui-flipswitch-active, html body .ui-flipswitch.ui-bar-b.ui-flipswitch-active, .ui-page-theme-b .ui-slider-track .ui-btn-active, html .ui-bar-b .ui-slider-track .ui-btn-active, html .ui-body-b .ui-slider-track .ui-btn-active, html body .ui-group-theme-b .ui-slider-track .ui-btn-active, html body div.ui-slider-track.ui-body-b .ui-btn-active{color: #3388cc;text-shadow:0 0px 0 #005599;font-weight:bold;}
.ui-page-theme-b .ui-btn:hover,html .ui-bar-b .ui-btn:hover,html .ui-body-b .ui-btn:hover,html body .ui-group-theme-b .ui-btn:hover,html head + body .ui-btn.ui-btn-b:hover{text-shadow:none;}
.ui-collapsible-inset, .ui-collapsible-set{margin: 0;}
.ui-collapsible-content{padding: 0em 0.5em .2em;margin: -.5em 0em;}
.ui-collapsible-set .ui-collapsible{margin: -.1em -1em 0;}
.ui-page-theme-a .ui-btn.ui-btn-active,
html .ui-bar-a .ui-btn.ui-btn-active,
html .ui-body-a .ui-btn.ui-btn-active,
html body .ui-group-theme-a .ui-btn.ui-btn-active,
html head + body .ui-btn.ui-btn-a.ui-btn-active{border-color: lightgray;/*color: #D94026;*/background: #FFF;text-shadow:none;color: #000;}
</style>
<script type="text/javascript">
var basicInfo = null;
var schemeInfo = null;
var proId = "";
var currUser = "";

$(function(){
	currUser = $("#loginInp").val();
	proId = getReqParam("proId");
	$('body').fontFlex(14, 60, 20);

	$(".navTab").click(switchTab);

	initPages();
});
function initPages(){
	$(".navTab").get(0).click();
	getProjectInfo();
	getSchemeInfo();
	getNewsList();
}
function switchTab (argument) {
	var _ind = $(this).attr("ind");
	var _left = (parseInt(_ind)*33.3)+"%";
	$("#posIcon").animate({"left": _left},"fast");

	$(".content").each(function(){
		if($(this).attr("id") == ("content_"+_ind)){
			$(this).show();
		}else{
			$(this).hide();
		}
	});
}
function getProjectInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../ProjectBasicController/getProjectById.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId},
		success:function(msg){
			if(msg.success){
				basicInfo = msg.baseModel;
				// $("#naviProName").text(msg.baseModel.projectName);
				$("#floorArea").text(msg.baseModel.floorArea+" 平方米");
				$("#structArea").text(msg.baseModel.structArea+" 平方米");
				$("#plotArea").text(msg.baseModel.plotArea);
				$("#saleStructArea").text(msg.baseModel.saleStructArea+" 平方米");
				$("#groundInp").text((new Date(msg.baseModel.groundDate)).format('yyyy-MM-dd'));
				$("#groundAmount").text(msg.baseModel.groundAmount+" 亿元");
				$("#groundType").text(msg.baseModel.groundType);
				$("#buildareaprice").text(msg.baseModel.buildareaprice +" 元/平方米");
				$("#groundPosition").text(msg.baseModel.groundPosition);
				$("#groundPositioning").text(msg.baseModel.groundPositioning);
				$("#groundPlanning").text(msg.baseModel.groundPlanning);
				$("#planFold").text(msg.baseModel.planFold+" 元/平方米");
				$("#planRent").text(msg.baseModel.planRent);
				$("#planIrr").text(msg.baseModel.planIrr+" %");
				$("#planGrossMargin").text(msg.baseModel.planGrossMargin+" %");
				$("#planMoic").text(msg.baseModel.planMoic);
				$("#stageStartInp").text((new Date(msg.baseModel.planStageStartDate)).format('yyyy-MM-dd'));
				$("#stageOpenInp").text((new Date(msg.baseModel.planStageOpenDate)).format('yyyy-MM-dd'));
				// $("#peakInp").text((new Date(msg.baseModel.planPeakeDate)).format('yyyy-MM-dd'));
				// $("#cashflowReturnInp").text((new Date(msg.baseModel.planCashflowReturnDate)).format('yyyy-MM-dd'));
				$("#returnDateInp").text(msg.baseModel.returndate+" 个月");				
				$("#deliverInp").text((new Date(msg.baseModel.planDeliverDate)).format('yyyy-MM-dd'));
				$("#carryoverInp").text((new Date(msg.baseModel.planCarryoverDate)).format('yyyy-MM-dd'));
				$("#liquidateInp").text((new Date(msg.baseModel.planLiquidateDate)).format('yyyy-MM-dd'));
				$("#planPropertyScheme").text(msg.baseModel.planPropertyScheme);
				$("#planFinanceCalculate").text(msg.baseModel.planFinanceCalculate);
				$("#corpPartnerBackground").text(msg.baseModel.corpPartnerBackground);
				$("#corpContributiveRatio").text(msg.baseModel.corpContributiveRatio);
				$("#corpBoardMember").text(msg.baseModel.corpBoardMember);
				$("#corpVoteRule").text(msg.baseModel.corpVoteRule);
				$("#restAnswerMail").text(msg.baseModel.restAnswerMail);
				// $("#restAnswerLink").text(msg.baseModel.restAnswerLink);
				$("#restProjectManagers").text(msg.baseModel.restProjectManagers);
				$("#restFollowerManagers").text(msg.baseModel.restFollowerManagers);
				// $("#riskDisclaimerDes").val(msg.baseModel.riskDisclaimerDes);
				// $("#schemeProtocol").val(msg.baseModel.schemeProtocol);
				// if(msg.baseModel.schemeProtocol){
				// 	var _temp = '<div style="color:red;">温馨提示：请在汇款后下载以上跟投协议，并填写个人信息部分，交至事业部/城市公司财务处核对，由人力统一盖章；或按《募集信息》要求执行。</div>';
 			// 		$("#protocal_info").html(structSchemeLink(msg.baseModel.schemeProtocol)+_temp);
				// }else{
				// 	$("#protocal_info").html("");
				// }
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}
function getSchemeInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../FollowSchemeController/getSchemeByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':proId},
		success:function(msg){
			if(msg.success){
				schemeInfo = msg.baseModel;
				 // $("#schemeid").text(msg.baseModel.schemeId);
				 $("#subscribeStartInp").text((new Date(msg.baseModel.subscribeStartDate)).format('yyyy-MM-dd'));
				 $("#subscribeEndtInp").text((new Date(msg.baseModel.subscribeEndDate)).format('yyyy-MM-dd'));
				 $("#payStartInp").text((new Date(msg.baseModel.payStartDate)).format('yyyy-MM-dd'));
				 $("#payEndInp").text((new Date(msg.baseModel.payEndDate)).format('yyyy-MM-dd'));
				 $("#payReleaseDateInp").text((new Date(msg.baseModel.projectReleaseDate)).format('yyyy-MM-dd'));
				 // $("#personamt").text(msg.baseModel.personamt);
				 // $("#yxpersonamt").text(msg.baseModel.yxpersonamt);
				 // $("#jtpersonamt").text(msg.baseModel.jtpersonamt);
				 $("#fundPeake").text((msg.baseModel.fundPeake)+" 亿元");
				 $("#followAmount").text(formatMillions(msg.baseModel.followAmount)+" 万元");
				 $("#followAmountDesc").val(msg.baseModel.followAmountDesc);
				 $("#groupForceRatio").text((msg.baseModel.groupForceRatio)+" %");
				 $("#groupForceAmount").text(formatMillions(msg.baseModel.groupForceAmount)+" 万元");
				 $("#compForceRatio").text((msg.baseModel.compForceRatio)+" %");
				 $("#compForceAmount").text(formatMillions(msg.baseModel.compForceAmount)+" 万元");
				 $("#compChoiceRatio").text((msg.baseModel.compChoiceRatio)+" %");
				 $("#compChoiceAmount").text(formatMillions(msg.baseModel.compChoiceAmount)+" 万元");
				 $("#leverageDes").text(msg.baseModel.leverageDes);
				 $("#subscribeRemind").text(msg.baseModel.subscribeRemind);
				 // $("#followChemeLink").html(structSchemeLink(msg.baseModel.followChemeLink));
				 // $("#followChemeLink").html(msg.baseModel.followChemeLink?'<a href="files/数据表.doc">跟投方案下载链接</a>':"");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getNewsList(){
	$.ajax({
		type:'post',//可选get
		// url:'../DynamicNewsController/getNewsListByUser.action',
		url:'../DynamicNewsController/getNewsListByProjectId.action',
		// contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		// data:'{"userid":"'+currUser+'","pageSize":"'+5+'","projectName":""}',
		data:{
			'projectId':proId,
			'title':"",
			'releaseBegin':"",
			'releaseEnd':""
		},
		success:function(msg){
			if(msg.success){
				newsList=msg.dataDto;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}
function loadNewsData(){
	var tempHtml = "";
	// newsList = [{}];  // 测试数据
	$.each(newsList, function(ind, val){
		tempHtml += '<li><a class="newsSTY" href="./newsDetail.jsp?newsId='+val.newsId+'" rel="external"><span class="dateSTY">'+formatDate(val.releaseDate)+'</span>&nbsp;'+val.title+'</a></li>';
		// tempHtml += '<div><a href="./newsDetail.jsp">2014-08-14&nbsp;&nbsp;关于《合肥高新项目跟投方案》公示及跟投申报的通知</a></div>';
	})
	$("#newsList").html(tempHtml);
	$("#newsList").listview('refresh');
}
function formatDate(ss){
	var dt=new Date(ss);
	var m = dt.getMonth()+1;
	var d = dt.getDate();
	var dtstr=dt.getFullYear()+"-"+(m<10?"0"+m:m)+"-"+(d<10?"0"+d:d);
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="header" data-position="fixed">
		<!-- <div data-role="controlgroup" data-type="horizontal">
			<a href="" data-role="button">基础信息</a>
			<a href="" data-role="button">跟投方案</a>
			<a href="" data-role="button">风险提示</a>
		</div> -->
		<div data-role="navbar">
			<ul>
				<li class="borderR_STY"><a data-theme="b" class="navTab" ind="0" href="">基础信息</a></li>
				<li class="borderR_STY"><a data-theme="b" class="navTab" ind="1" href="">跟投方案</a></li>
				<li><a data-theme="b" class="navTab" ind="2" href="">风险提示</a></li>
			</ul>
		</div>
		<div id="posIcon"></div>
	</div>
	<div id="content_0" class="content" data-role="content">
		<div data-role="collapsible-set" data-inset="false">
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-collapsed="true">
				<h3>基础信息</h3>
				<p><table width="100%" border="1">
					<tr><td class="titleTd">占地面积</td>
					<td id="floorArea"></td></tr>
					<tr><td class="titleTd">计容面积</td>
					<td id="structArea"></td></tr>
					<tr><td class="titleTd">容积率</td>
					<td id="plotArea"></td></tr>
					<tr><td class="titleTd">可销售的计容建面</td>
					<td id="saleStructArea"></td></tr>
					<tr><td class="titleTd">土地获取时间</td>
					<td width="300" id="groundInp"></td></tr>
					<tr><td class="titleTd">地价总额</td>
					<td id="groundAmount"></td></tr>
					<tr><td class="titleTd">获取方式</td>
					<td id="groundType"></td></tr>
					<tr><td class="titleTd">楼面地价</td>
					<td id="buildareaprice"></td></tr>
					<tr><td class="titleTd">项目区位</td>
					<td id="groundPosition"></td></tr>
					<tr><td class="titleTd">产品定位</td>
					<td id="groundPositioning"></td></tr>
					<tr><td class="titleTd">规划方案</td>
					<td id="groundPlanning"></td></tr>
				</table></p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>经营计划</h3>
				<p><table width="100%" border="1">
					<tr><td class="titleTd">项目均价</td>
					<td id="planFold"></td></tr>
					<tr><td class="titleTd">持有型物业租金水平</td>
					<td id="planRent"></td></tr></tr>
					<tr><td class="titleTd">项目IRR</td>
					<td id="planIrr"></td></tr>
					<tr><td class="titleTd">预计销售毛利率</td>
					<td id="planGrossMargin"></td></tr>
					<tr><td class="titleTd">开工时间</td>
					<td id="stageStartInp"></td></tr>
					<tr><td class="titleTd">开盘时间</td>
					<td id="stageOpenInp"></td></tr>
					<tr><td class="titleTd">现金流回正时间</td>
					<td id="returnDateInp"></td></tr>
					<tr><td class="titleTd">交付时间</td>
					<td id="deliverInp"></td></tr>
					<tr><td class="titleTd">结转时间</td>
					<td id="carryoverInp"></td></tr>
					<tr><td class="titleTd">清算时间</td>
					<td id="liquidateInp"></td></tr>
					<tr><td class="titleTd">持有物业处理方案</td>
					<td id="planPropertyScheme"></td></tr>
				</table></p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>合作信息</h3>
				<p><table width="100%" border="1">
					<tr><td class="titleTd">合作方背景和资质</td>
					<td id="corpPartnerBackground"></td></tr>
					<tr><td class="titleTd">项目出资比例</td>
					<td id="corpContributiveRatio"></td></tr>
				</table></p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>新闻动态</h3>
				<p><ul id="newsList" data-role="listview" data-inset="true" data-shadow="false">
					<!-- <li><a href="">2014-10-10 项目</a></li>
					<li><a href="">2014-10-10 项目</a></li>
					<li><a href="">2014-10-10 项目</a></li>
					<li><a href="">2014-10-10 项目</a></li>
					<li><a href="">2014-10-10 项目</a></li> -->
				</ul></p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>其他信息</h3>
				<p><table width="100%" border="1">
					<tr><td class="titleTd">答疑邮箱</td>
					<td id="restAnswerMail"></td></tr>
					<tr><td class="titleTd">项目信息管理员</td>
					<td id="restProjectManagers"></td></tr>
					<tr><td class="titleTd">项目跟投管理员</td>
					<td id="restFollowerManagers"></td></tr>
				</table></p>
			</div>
		</div>
	</div>
	<div id="content_1" class="content" data-role="content">
		<div data-role="collapsible-set" data-inset="false">
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-collapsed="true">
				<h3>跟投计划安排</h3>
				<p><table width="100%" border="1">
					<tr><td class="titleTd">认购开始时间</td>
					<td id="subscribeStartInp"></td></tr>
					<tr><td class="titleTd">认购结束时间</td>
					<td id="subscribeEndtInp"></td></tr>
					<tr><td class="titleTd">付款开始时间</td>
					<td id="payStartInp"></td></tr>
					<tr><td class="titleTd">付款结束时间</td>
					<td id="payEndInp"></td></tr>
					<tr><td class="titleTd">资金峰值</td>
					<td id="fundPeake"></td></tr>
					<tr><td class="titleTd">可跟投总额(含杠杆)</td>
					<td id="followAmount"></td></tr>
					<tr><td class="titleTd">集团强投包比例</td>
					<td id="groupForceRatio"></td></tr>
					<tr><td class="titleTd">集团强投包总额</td>
					<td id="groupForceAmount"></td></tr>
					<tr><td class="titleTd">城市公司强投包比例</td>
					<td id="compForceRatio"></td></tr>
					<tr><td class="titleTd">城市公司强投包总额</td>
					<td id="compForceAmount"></td></tr>
					<tr><td class="titleTd">选投包比例(无杠杆)</td>
					<td id="compChoiceRatio"></td></tr>
					<tr><td class="titleTd">选投包总额(无杠杆)</td>
					<td id="compChoiceAmount"></td></tr>
					<tr><td class="titleTd">杠杆认购说明</td>
					<td id="leverageDes"></td></tr>
					<tr style="display:none;"><td class="titleTd">项目跟投小组</td>
					<td id="followAmountDesc"></td></tr>
					<tr><td class="titleTd">募集方式</td><!-- "认购提醒"字段变更为"募集方式" -->
					<td id="subscribeRemind"></td></tr>
					<tr style="display:none;"><td class="titleTd">跟投方案</td>
					<td id="followChemeLink"></td></tr>
					</table></p>
			</div>
		</div>
	</div>
	<div id="content_2" class="content" data-role="content">
		<!-- <div data-role="collapsible-set" data-inset="false">
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>基础信息</h3>
			</div>
		</div> -->
		<div class="fontSTY">
			1.跟投项目属于长期投资、股权而非债券投资，需与其他投资人共担风险，且投资回报具有波动性、不确定型。<br>
			<br>2.根据不同的项目，跟投人员短期内的现金回流情况不同。<br>
			<br>3.不同的城市公司、跟投项目的投资收益不具有可比性，同一城市公司或团队的不同跟投项目的投资收益也不具有可比性，只能对跟投项目的经营结果做出预测，但无法保证。<br>
			<br>4.跟投人员并非项目公司的直接股东或投资人，作为间接投资人，无权控制或参与项目运营，跟投人员须依赖有限合伙企业或代持人来执行项目层面的监督或建议。<br>
			<br>5.项目开发运作期内，不可转让、赎回跟投份额，跟投人无法在项目本金分配、分红前实现投资变现。<br>
			<br>6.跟投员工中途离职不影响其已购份额的本金收回与利润分配，其本金与利润分配均需满足本制度规定的分配条件以及项目公司合作约定条件等。<br>
			<br>7.项目不利因素提示：<br>
			&nbsp;&nbsp;&nbsp;7.1受当地预售款资金监管政策影响，可能存在因资金使用受限导致无法及时分配资金的风险。<br>
			&nbsp;&nbsp;&nbsp;7.2受当地税务政策影响，可能存在项目实际税负率波动以及项目清算时间的风险。<br>
			&nbsp;&nbsp;&nbsp;7.3操盘团队面临来自行业的竞争，跟投项目的经营结果可能会在一定程度上受到竞争因素的影响，项目管理团队可以针对市场变化采取合理的经营措施。
		</div>
	</div>
</div>
</body>
</html>