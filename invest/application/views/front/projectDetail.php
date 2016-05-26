<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>项目详细</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/projectDetail.css')?>">


<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
<style type="text/css">
	#ul-pics li {
    width: 32%;
    float: left;
    /* height: 300px; */
    margin-right: 1%;
    border: 1px solid #CCCCCC;
    margin-top: 1%;
}

input#item_pic {
	width: 200px;
}

</style>
</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
	<p style="display:none" id="site_url"><?php echo site_url();?></p>
<div id="contentLayer">
	<div id="naviTitle">
		<a href="<?php echo site_url()?>">首页</a> >
		<a href="<?php echo site_url()?>home/index/projectList?query=0">认购项目列表 </a> > <a id="naviProName" href="#">合肥高新项目</a>
	</div>
	<div id="contentFrame">
		<div id="titleTab">
			<div anchor="basic" class="tabSTY focusOn">项目基础信息</div>
			<div anchor="scheme" class="tabSTY">跟投方案</div>
			<!--div anchor="danger" class="tabSTY">风险提示</div-->
			<div anchor="protocal" class="tabSTY">跟投协议</div>
			<div anchor="force" class="tabSTY">跟投人员</div>
			<div anchor="news" class="tabSTY">项目动态新闻</div>
			<div anchor="pics" class="tabSTY">项目图片库</div>
		</div>
		<div id="basic_info" class="info_STY">
			<div class="moduleTitle" ind="0_0">
				<img src="<?php echo site_url().'application/views/front/images/arrow_down.png' ?>" width="13" height="13" />基础信息
			</div>
			<div id="0_0" class="content">
				<div class="titleSTY">项目体量</div>
				<table border="1"><tr>
					<td class="titleTd">占地面积</td>
					<td width="300" id="floorArea">9.8万平方米</td>
					<td class="titleTd">计容面积</td>
					<td id="structArea">4.4万平方米</td>
				</tr><tr>
					<td class="titleTd">容积率</td>
					<td id="plotArea"></td>
					<td class="titleTd">可销售的计容建面</td>
					<td id="saleStructArea"></td>
				</tr></table>
				<div class="titleSTY">拿地情况</div>
				<table border="1"><tr>
					<td class="titleTd">土地获取时间</td>
					<td width="300" id="groundInp"></td>
					<td class="titleTd">地价总额</td>
					<td id="groundAmount"></td>
				</tr><tr>
					<td class="titleTd">获取方式</td>
					<td id="groundType"></td>
					<td class="titleTd">楼面地价</td>
					<td id="buildareaprice"></td>
				</tr><tr>
					<td class="titleTd">项目区位</td>
					<td colspan="3" class="richTd" id="groundPosition"></td>
				</tr><tr>
					<td class="titleTd">产品定位</td>
					<td colspan="3" class="richTd" id="groundPositioning"></td>
				</tr><tr>
					<td class="titleTd">规划方案</td>
					<td colspan="3" class="richTd" id="groundPlanning"></td>
				</tr></table>
			</div>
			<div class="moduleTitle" ind="0_1">
				<img src="<?php echo site_url().'application/views/front/images/arrow_down.png' ?>" width="13" height="13" />经营计划
			</div>
			<div id="0_1" class="content" style="">
				<div class="titleSTY">预计销售计划</div>
				<table border="1"><tr>
					<td class="titleTd">项目均价</td>
					<td width="300" id="planFold"></td>
					<td class="titleTd">持有型物业租金水平</td>
					<td id="planRent"></td>
				</tr></table>
				<div class="titleSTY">预计回报水平</div>
				<table border="1"><tr>
					<td class="titleTd">项目IRR</td>
					<td width="300" id="planIrr"></td>
					<td class="titleTd"></td>
					<td id="planGrossMargin"></td>
				</tr>
				<tr>
					<td class="titleTd">税前销售利润率</td>
					<td width="300" id="FPREPROFIT"></td>
					<td class="titleTd">税后销售净利润率</td>
					<td id="FPROFIT"></td>
				</tr>
				<tr class="displayNone">
					<td class="titleTd">跟投MOIC(税前)</td>
					<td width="300" id="planMoic"></td>
					<td class="titleTd"></td>
					<td></td>
				</tr></table>
				<div class="titleSTY">预计运营开发计划</div>
				<table border="1"><tr>
					<td class="titleTd">开工时间</td>
					<td width="300" id="stageStartInp"></td>
					<td class="titleTd">开盘时间</td>
					<td id="stageOpenInp"></td>
				</tr><tr>
					<!-- <td class="titleTd">资金峰值时间</td>
					<td id="peakInp"></td> -->
					<!-- <td class="titleTd">现金流回正时间</td>
					<td id="cashflowReturnInp"></td> -->
					<td class="titleTd">现金流回正时间</td>
					<td id="returnDateInp"></td>
					<td class="titleTd">交付时间</td>
					<td id="deliverInp"></td>
				</tr><tr>
					<td class="titleTd">结转时间</td>
					<td id="carryoverInp"></td>
					<td class="titleTd">清算时间</td>
					<td colspan="3" id="liquidateInp"></td>
				</tr><tr>
					<td class="titleTd">持有物业处理方案</td>
					<td colspan="3" class="richTd" id="planPropertyScheme"></td>
				</tr><tr class="displayNone">
					<td class="titleTd">财务测算文件</td>
					<td colspan="3" class="richTd" id="planFinanceCalculate"></td>
				</tr></table>
			</div>
			<div class="moduleTitle" ind="0_2">
				<img src="<?php echo site_url().'application/views/front/images/arrow_down.png' ?>" width="13" height="13" />合作信息
			</div>
			<div id="0_2" class="content" style="">
				<div class="titleSTY">预计回报水平</div>
				<table border="1"><tr>
					<td class="titleTd">合作方背景和资质</td>
					<td colspan="3" class="richTd" id="corpPartnerBackground"></td>
				</tr><tr>
					<td class="titleTd">项目出资比例</td>
					<td colspan="3" id="corpContributiveRatio"></td>
				</tr><tr class="displayNone">
					<td class="titleTd">董事会组成</td>
					<td colspan="3" class="richTd" id="corpBoardMember"></td>
				</tr><tr class="displayNone">
					<td class="titleTd">项目公司股东会及董事会表决比例和表决规则</td>
					<td colspan="3" class="richTd" id="corpVoteRule"></td>
				</tr></table>
			</div>
			<div class="moduleTitle" ind="0_3">
				<img src="<?php echo site_url().'application/views/front/images/arrow_down.png' ?>" width="13" height="13" />其他信息
			</div>
			<div id="0_3" class="content" style="">
				<table border="1"><tr>
					<td class="titleTd">答疑邮箱</td>
					<td colspan="3" id="restAnswerMail"></td>
				</tr><!-- <tr>
					<td class="titleTd">答疑讨论区链接</td>
					<td colspan="3" id="restAnswerLink"></td>
				</tr> --><tr>
					<td class="titleTd">项目信息管理员</td>
					<td colspan="3" class="richTd" id="restProjectManagers"></td>
				</tr><tr>
					<td class="titleTd">项目跟投管理员</td>
					<td colspan="3" class="richTd" id="restFollowerManagers"></td>
				</tr></table>
			</div>
			<div class="moduleTitle" ind="0_4" style="display:none;">
				<img src="<?php echo site_url().'application/views/front/images/arrow_down.png' ?>" width="13" height="13" />相关图片
			</div>
			<div id="0_4" class="content" style="display:none;">
				<div class="picSTY"><img src="./images/254_142.png" width="254" height="142"></div>
				<div class="picSTY"><img src="./images/254_142.png" width="254" height="142"></div>
				<div class="picSTY"><img src="./images/254_142.png" width="254" height="142"></div>
			</div>
		</div>
		<div id="scheme_info" class="info_STY" style="display:none">
			<div class="content">
				<!--div class="titleSTY" class="displayNone">跟投计划安排</div-->
				<table border="1"><tr>
					<td class="titleTd">认购开始时间</td>
					<td width="300" id="subscribeStartInp"></td>
					<td class="titleTd">认购结束时间</td>
					<td id="subscribeEndtInp"></td>
				</tr><tr>
					<td class="titleTd">付款开始时间</td>
					<td id="payStartInp"></td>
					<td class="titleTd">付款结束时间</td>
					<td id="payEndInp"></td>
				</tr><tr>
					<td class="titleTd">资金峰值</td>
					<td id="fundPeake"></td>
					<!--td class="titleTd">可跟投总额(含杠杆)</td>
					<td id="followAmount"></td-->
				</tr><!-- <tr>
					<td class="titleTd">可跟投总额包括</td>
					<td colspan="3" class="richTd" id="followAmountDesc"></td>
				</tr> --><tr>
					<td class="titleTd">总部跟投比例</td>
					<td id="groupForceRatio"></td>
					<td class="titleTd">总部最大可跟投总额（含杠杆）</td>
					<td id="groupForceAmount"></td>
				</tr><tr>
					<td class="titleTd">区域跟投比例</td>
					<td id="compForceRatio"></td>
					<td class="titleTd">区域最大可跟投总额（含杠杆）</td>
					<td id="compForceAmount"></td>
				</tr><tr>
					<td class="titleTd">全部跟投比例</td>
					<td id="compChoiceRatio"></td>
					<td class="titleTd">全部最大可跟投总额（含杠杆）</td>
					<td id="compChoiceAmount"></td>
				</tr>
				<tr>
					<td class="titleTd">总部已跟投总额（含杠杆）</td>
					<td id="zbze"></td>
					<td class="titleTd">总部个人自有资金投入总额</td>
					<td id="zbzy"></td>
				</tr>
				<tr>
					<td class="titleTd">总部平均杠杆水平</td>
					<td id="zbsp"></td>
					<td class="titleTd"></td>
					<td id=""></td>
				</tr>
				<tr>
					<td class="titleTd">区域已跟投总额（含杠杆）</td>
					<td id="qyze"></td>
					<td class="titleTd">区域个人自有资金投入总额</td>
					<td id="qyzy"></td>
				</tr>
				<tr>
					<td class="titleTd">区域平均杠杆水平</td>
					<td id="qysp"></td>
					<td class="titleTd"></td>
					<td id=""></td>
				</tr>
				<tr>
					<td class="titleTd">全部已跟投总额（含杠杆）</td>
					<td id="qbze"></td>
					<td class="titleTd">全部个人自有资金投入总额</td>
					<td id="qbzy"></td>
				</tr>
				<tr>
					<td class="titleTd">平均杠杆水平</td>
					<td id="qbsp"></td>
					<td class="titleTd"></td>
					<td id=""></td>
				</tr>


				<!--tr>
					<td class="titleTd">全部跟投比例</td>
					<td colspan="3" class="richTd" id="leverageDes"></td>
				</tr><tr>
					<td class="titleTd">全部最大可跟投总额（含杠杆）</td>
					<td colspan="3" class="richTd"><textarea id="followAmountDesc" style="height:100%;width:100%;resize:none;border:none;outline:none;" readonly></textarea></td>
				</tr--><tr>
					<td class="titleTd">募集方式</td><!-- "认购提醒"字段变更为"募集方式" -->
					<td colspan="3" class="richTd" id="subscribeRemind"></td>
				</tr><!--tr>
					<td class="titleTd">跟投方案</td>
					<td colspan="3" class="richTd" id="followChemeLink"></td>
				</tr--></table>
			</div>
		</div>
		<div id="danger_info" class="info_STY" style="display:none;">
			<!--pre>

1.跟投项目属于长期投资、股权而非债券投资，需与其他投资人共担风险，且投资回报具有波动性、不确定型。
2.根据不同的项目，跟投人员短期内的现金回流情况不同。
3.不同的城市公司、跟投项目的投资收益不具有可比性，同一城市公司或团队的不同跟投项目的投资收益也不具有可比性，只能对跟投项目的经营结果做出预测，但无法保证。
4.跟投人员并非项目公司的直接股东或投资人，作为间接投资人，无权控制或参与项目运营，跟投人员须依赖有限合伙企业或代持人来执行项目层面的监督或建议。
5.项目开发运作期内，不可转让、赎回跟投份额，跟投人无法在项目本金分配、分红前实现投资变现。
6.跟投员工中途离职不影响其已购份额的本金收回与利润分配，其本金与利润分配均需满足本制度规定的分配条件以及项目公司合作约定条件等。
7.项目不利因素提示：
  7.1受当地预售款资金监管政策影响，可能存在因资金使用受限导致无法及时分配资金的风险。
  7.2受当地税务政策影响，可能存在项目实际税负率波动以及项目清算时间的风险。
  7.3操盘团队面临来自行业的竞争，跟投项目的经营结果可能会在一定程度上受到竞争因素的影响，项目管理团队可以针对市场变化采取合理的经营措施。
			</pre-->
		</div>
		<div id="protocal_info" class="info_STY" style="display:none;">
			<!--div>协议下载地址：<a id="protocalDown" href="javascript:void(0)">合肥高新项目跟投协议内容.docx</a></div-->
		</div>
		<div id="force_info" class="info_STY" style="display:none;">
			<br><!--div class="titleSTY">强制跟投人员名单</div-->
			<table border="1"><thead><tr>
				<td rowspan="2" width="50">序号</td>
				<td rowspan="2" width="90">姓名</td>
				<td rowspan="2" width="150">区域/总部</td> <!-- "所属公司"字段名改为：认购类型 -->
				<td rowspan="2" width="150">职务</td>
				<td colspan="2" height="17">个人额度范围</td>
				<td rowspan="2">备注</td>
			</tr><tr>
				<td width="150">上限(万元)</td>
				<td width="150" height="17">下限(万元)</td>
			</tr></thead>
			<tbody id="forceTbody">
				<!-- <tr>
					<td height="30">1</td>
					<td>张三</td>
					<td>集团</td>
					<td>集团高管</td>
					<td>执行副总裁</td>
					<td>10,000</td>
					<td>22,000</td>
					<td></td>
				</tr> -->
			</tbody></table>
		</div>
		<div id="news_info" class="info_STY" style="display:none;">
			<br><table border="1"><thead><tr>
				<td width="50" height="34">序号</td>
				<td width="650">标题</td>
				<td width="200">创建时间</td>
				<td>作者</td>
			</tr></thead>
			<tbody id="newsTbody">
				<!-- <tr>
					<td height="30">1</td>
					<td>合肥高新项目付款对账完成公示</td>
					<td>2014-09-01</td>
					<td>李四</td>
				</tr> -->
			</tbody></table>
		</div>
		<div id="pics_info" class="info_STY" style="display:none;">
			<div>
				<p>封面图片</p>
				<img src="<?php echo site_url();?>images/default.jpg" width="600px" id="main_pic">
			</div>
			<div>
				<p>项目图片</p>
				<ul id="ul-pics">
				</ul>
			</div>
		</div>
	</div>
</div>



<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "1";
// 页签下标
var tabInd = "basic";
var projectId = null;
var forceList = null;
var basicInfo = null;
var schemeInfo = null;
var newsInfo = null;
var tabFlag = "";

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	projectId = getReqParam("proId");
	tabFlag = getReqParam("tabInd");
}

function initListeners(){
	initHeaderListeners();

	$("#titleTab .tabSTY").click(function(){
		$("#titleTab .tabSTY").removeClass("focusOn");
		$(this).addClass("focusOn");
		$("#"+tabInd+"_info").hide();

		tabInd = $(this).attr("anchor");
		$("#"+tabInd+"_info").show();
	});

	$("#basic_info .moduleTitle").click(function(){
		var _id = $(this).attr("ind")
		var _display = $("#"+_id).css("display");
		var url = $('#site_url').text();
		if("none" == _display){
			$(this).find("img").attr("src", url+'application/views/front/images/arrow_down.png');
			//$("#"+_id).show();
		}else{
			$(this).find("img").attr("src",url+'application/views/front/images/arrow_up.png');
			//$("#"+_id).hide();
		}
		$("#"+_id).toggle();
	});
}

function initPages () {
	getProjectInfo();
	getSchemeInfo();
	getForceList();
	getNewsList();
	getMainPic();
	getPics();

	$("#titleTab .tabSTY[anchor="+tabFlag+"]").click();
}

function getMainPic()
{
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'Pic/getMainImage',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				//$("#projectInp").val(msg.data[0].FNAME);
				if (msg.data.length > 0) 
				{
					$("#main_pic").attr("src",ctx+"images/"+msg.data[0].FNAME);
				};
			}else{
				alert("Get main pic failed: "+msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function getPics()
{
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'Pic/getAllProjectImage',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				//$("#projectInp").val(msg.data[0].FNAME);
				/*
				<li>
					<div><img src="http://localhost/application/views/front/img/title.jpg" width="100%"></div>
					<div><p class="deletePic" ><a onclick="delPic(this.id)">删除照片</a></p></div>
				</li>
				*/
				var picList = msg.data;
				var tempHtml = "";

				$.each(picList, function(ind, val){
					tempHtml += ('<li><div><img src="'+ctx+"images/"+val.FNAME+'" width="100%"></div></li>');
					//tempHtml += ('<div><p class="deletePic" ><a onclick="delPic('+val.FID+')">删除照片</a></p></div></li>');
				});
				$("#ul-pics").html(tempHtml);

			}else{
				alert("aa"+msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}


function getProjectInfo(){
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'/Project/getProjectDetail',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				data = msg.data[0];

				/*
				$("#projectName").val(data.FNAME);
				$("#floorArea").val(data.FAREA);//占地面积
				$("#structArea").val(data.FSTRUCTAREA);//计容键面
				$("#plotArea").val(data.FRJL);//容积率
				$("#saleStructArea").val(data.FSALEAREA);//可销售计容面积
				$("#groundInp").val((new Date(data.FGETDATE)).format('yyyy-MM-dd hh:mm:ss'));//获取时间
				$("#groundAmount").val(data.FTOTAL);//地价总价
				$("#returndate").val(data.FCASHFLOWBACK); //现金流回正时间 个月
				//$("#buildareaprice").val(data.FPRICE);//楼面地价
				$("#groundType").val(data.FGETWAY);//获取方式
				$("#groundPosition").val(data.FPOSITION);//项目区位
				// $("#projectarea").val(data.baseModel.projectarea);
				$("#groundPositioning").val(data.FPROPOSITION);//产品定位
				$("#groundPlanning").val(data.FSCHEME);//规划方案
				$("#planFold").val(data.FPRICE);//项目均价
				$("#planRent").val(data.FCYWYSP);//持有型物业租金水平
				$("#planIrr").val(data.FIRR);
				$("#FPREPROFIT").val(data.FPREPROFIT);//税前销售利润率
				$("#FPROFIT").val(data.FPROFIT);//税后销售净利润率
				//开工时间
				$("#stageStartInp").val((new Date(data.FSTARTDATE)).format('yyyy-MM-dd hh:mm:ss'));
				//开盘时间
				$("#stageOpenInp").val((new Date(data.FOPENDATE)).format('yyyy-MM-dd hh:mm:ss'));
				// $("#peakInp").val((new Date(data.baseModel.planPeakeDate)).format('yyyy-MM-dd hh:mm:ss'));
				// $("#cashflowReturnInp").val((new Date(data.baseModel.planCashflowReturnDate)).format('yyyy-MM-dd hh:mm:ss'));
				//交付时间
				$("#deliverInp").val((new Date(data.FHANDDATE)).format('yyyy-MM-dd hh:mm:ss'));
				//结转时间
				$("#carryoverInp").val((new Date(data.FCARRYOVERDATE)).format('yyyy-MM-dd hh:mm:ss'));
				//清算时间
				$("#liquidateInp").val((new Date(data.FLIQUIDATE)).format('yyyy-MM-dd hh:mm:ss'));
				$("#planPropertyScheme").val(data.FPROPERTYSCHEME);//持有物业处理方案
				//$("#planFinanceCalculate").val('data.baseModel.planFinanceCalculate');//财务测算文件
				$("#corpPartnerBackground").val(data.FPARTNERINFO);//合作方背景和资质
				$("#corpContributiveRatio").val(data.FCONTRIBUTIVE);//项目出资比例
				//$("#corpBoardMember").val('data.baseModel.corpBoardMember');//董事会组成
				//$("#corpVoteRule").val('data.baseModel.corpVoteRule');
				$("#restAnswerMail").val(data.FANSWERMAIL);//答疑邮箱地址
				// $("#restAnswerLink").val(data.baseModel.restAnswerLink);
				$("#restProjectManagers").val(data.FPROJECTINFOMANAGERS);//项目信息管理员
				$("#restFollowerManagers").val(data.FFOLLOWERMANAGERS);
				//$("#riskDisclaimerDes").val('data.baseModel.riskDisclaimerDes');//风险与免责
				// $("#schemeProtocol").val(data.baseModel.schemeProtocol);
 				//$("#protocalLinkTd").html('splitSchemeProtocal(msg.data.baseModel.schemeProtocol)');
				*/


				$("#naviProName").text(data.FNAME);
				$("#floorArea").text((data.FAREA||0)+" 平方米");
				$("#structArea").text(data.FSTRUCTAREA||0+" 平方米");
				$("#plotArea").text(data.FRJL||0);
				$("#saleStructArea").text(data.FSALEAREA||0+" 平方米");
				$("#groundInp").text((new Date(data.FGETDATE)).format('yyyy-MM-dd'));
				$("#groundAmount").text(data.FTOTAL||0+" 亿元");
				$("#groundType").text(data.FGETWAY||"");
				$("#buildareaprice").text(data.FPRICE||0 +" 元/平方米");
				$("#groundPosition").text(data.FPOSITION||"");
				$("#groundPositioning").text(data.FPROPOSITION||"");
				$("#groundPlanning").text(data.FSCHEME||"");
				$("#planFold").text(data.FPRICE||0+" 元/平方米");
				$("#planRent").text(data.FCYWYSP||0);
				$("#planIrr").text(data.FIRR||0+" %");
				//$("#planGrossMargin").text(data.planGrossMargin+" %");
				$("#FPREPROFIT").text(data.FPREPROFIT||0+" %");
				//$("#planMoic").text(data.planMoic);
				$("#FPROFIT").text(data.FPROFIT||0+"%");

				$("#stageStartInp").text((new Date(data.FSTARTDATE)).format('yyyy-MM-dd'));
				$("#stageOpenInp").text((new Date(data.FOPENDATE)).format('yyyy-MM-dd'));
				// $("#peakInp").text((new Date(data.planPeakeDate)).format('yyyy-MM-dd'));
				// $("#cashflowReturnInp").text((new Date(data.planCashflowReturnDate)).format('yyyy-MM-dd'));
				$("#returnDateInp").text(data.FCASHFLOWBACK||0+" 个月");				
				$("#deliverInp").text((new Date(data.FHANDDATE)).format('yyyy-MM-dd'));
				$("#carryoverInp").text((new Date(data.FCARRYOVERDATE)).format('yyyy-MM-dd'));
				$("#liquidateInp").text((new Date(data.FLIQUIDATE)).format('yyyy-MM-dd'));
				$("#planPropertyScheme").text(data.FPROPERTYSCHEME||"");
				//$("#planFinanceCalculate").text(data.planFinanceCalculate);
				$("#corpPartnerBackground").text(data.FPARTNERINFO||"");
				$("#corpContributiveRatio").text(data.FCONTRIBUTIVE||0);
				//$("#corpBoardMember").text(data.corpBoardMember);
				//$("#corpVoteRule").text(data.corpVoteRule);
				$("#restAnswerMail").text(data.FANSWERMAIL||"");
				// $("#restAnswerLink").text(data.restAnswerLink);
				$("#restProjectManagers").text(data.FPROJECTINFOMANAGERS||"");
				$("#restFollowerManagers").text(data.FFOLLOWERMANAGERS||"");
				// $("#riskDisclaimerDes").val(data.riskDisclaimerDes);
				// $("#schemeProtocol").val(data.schemeProtocol);
				/*if(msg.baseModel.schemeProtocol){
					var _temp = '<div style="color:red;">温馨提示：请在汇款后下载以上跟投协议，并填写个人信息部分，交至事业部/城市公司财务处核对，由人力统一盖章；或按《募集信息》要求执行。</div>';
 					$("#protocal_info").html(structSchemeLink(msg.baseModel.schemeProtocol)+_temp);
				}else{
					$("#protocal_info").html("");
				}*/
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
	var ctx="<?php echo site_url();?>";
	var projectId=getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'/FollowScheme/getFollowShemeListWithProjectID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){

				/*
									 var data = msg.data[0];
				 $("#schemeid").val(data.FID);
				 $("#uploadSchemeId").val(data.FID);
				 //认购开始时间
				 $("#subscribeStartInp").val((data.FSUBSCRIBESTARTDATE?new Date(data.FSUBSCRIBESTARTDATE):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 //认购结束时间
				 $("#subscribeEndtInp").val((data.FSUBSCRIBEENDDATE?new Date(data.FSUBSCRIBEENDDATE):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 //付款开始时间
				 $("#payStartInp").val((data.FPAYSTARTDATE?new Date(data.FPAYSTARTDATE):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 //付款结束时间
				 $("#payEndInp").val((data.FPAYENDDATE?new Date(data.FPAYENDDATE):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 //项目发布时间
				 //$("#payReleaseDateInp").val((data.projectReleaseDate?new Date(data.projectReleaseDate):new Date()).format('yyyy-MM-dd hh:mm:ss'));
				 //
				 //$("#personamt").val(data.personamt);
				 // $("#yxpersonamt").val(data.yxpersonamt);
				 // $("#jtpersonamt").val(data.jtpersonamt);

				 //$("#followAmount").val(data.followAmount / 10000);
				 //资金峰值
				 $("#fundPeake").val(data.FFUNDPEAKE);
				 //
				 //$("#maxamount").val(data.maxamount / 10000);
				 //$("#minamount").val(data.minamount / 10000);
				 //项目跟投小组
				 $("#followAmountDesc").val(data.FFOLLOWTEAM);
				 //总部跟投比例
				 $("#groupForceRatio").val(data.FHDRATIO);
				 //总部最大可跟投总额（含杠杆）
				 $("#groupForceAmount").val(data.FHDAMOUNT / 10000);
				 //区域跟投比例
				 $("#compForceRatio").val(data.FREGIONRATIO);
				 //区域最大可跟投总额（含杠杆）
				 $("#compForceAmount").val(data.FREGIONAMOUNT / 10000);
				 //全部跟投比例
				 $("#compChoiceRatio").val(data.FALLRATION);
				 //全部最大可跟投总额（含杠杆）
				 $("#compChoiceAmount").val(data.FALLAMOUNT / 10000);
				 //杠杆认购说明
				 $("#leverageDes").val(data.FLEVERAGEDES);
				 //募集方式
				 $("#subscribeRemind").val(data.FCOLLECTWAY);
				 // $("#followChemeLink").val(data.followChemeLink);
				 $("#schemeLinkTd").html(splitSchemeLink(data.FLINK));

				*/
				data = msg.data[0];
				 // $("#schemeid").text(msg.baseModel.schemeId);
				 $("#subscribeStartInp").text((new Date(data.FSUBSCRIBESTARTDATE)).format('yyyy-MM-dd'));
				 $("#subscribeEndtInp").text((new Date(data.FSUBSCRIBEENDDATE)).format('yyyy-MM-dd'));
				 $("#payStartInp").text((new Date(data.FPAYSTARTDATE)).format('yyyy-MM-dd'));
				 $("#payEndInp").text((new Date(data.FPAYENDDATE)).format('yyyy-MM-dd'));
				 //$("#payReleaseDateInp").text((new Date(data.projectReleaseDate)).format('yyyy-MM-dd'));
				 // $("#personamt").text(data.personamt);
				 // $("#yxpersonamt").text(data.yxpersonamt);
				 // $("#jtpersonamt").text(data.jtpersonamt);
				 $("#fundPeake").text((data.FFUNDPEAKE||0)+" 亿元");
				 //$("#followAmount").text(formatMillions(data.followAmount)+" 万元");
				 $("#followAmountDesc").val(data.FFOLLOWTEAM||"");
				 $("#groupForceRatio").text((data.FHDRATIO||0)+" %");
				 $("#groupForceAmount").text((data.FHDAMOUNT||0)+" 万元");
				 $("#compForceRatio").text((data.FREGIONRATIO||0)+" %");
				 $("#compForceAmount").text((data.FREGIONAMOUNT||0)+" 万元");
				 $("#compChoiceRatio").text((data.FALLRATION||0)+" %");
				 $("#compChoiceAmount").text((data.FALLAMOUNT||0)+" 万元");
				 $("#leverageDes").text(data.FLEVERAGEDES||0);
				 $("#subscribeRemind").text(data.FCOLLECTWAY||"");
				 /*
TATOLHASAMOUNT: "290"
TATOLHASFLEVERAMOUNT: "180"
TATOLHASHDPERSONSU: "20"
TATOLHASHDSU: "60"
TATOLHASHDSUFLEVERAMOUNT: "40"
TATOLHASPERSONAMOUNT: "290"
TATOLHASRGPERSONSU: null
TATOLHASRGSU: null
TATOLHASRGSUFLEVERAMOUNT: null
				 */
				 $("#zbze").text((data.TATOLHASHDSU||0)+" 万元");
				 $("#zbzy").text((data.TATOLHASHDPERSONSU||0)+" 万元");
				 var zbsp = (parseInt(data.TATOLHASHDPERSONSU||0)/parseInt(data.TATOLHASHDSUFLEVERAMOUNT||0)*100|| 0);
				 $("#zbsp").text((zbsp.toFixed(2)||0)+" %");

				 $("#qyze").text((data.TATOLHASRGSU||0)+" 万元");
				 $("#qyzy").text((data.TATOLHASRGPERSONSU||0)+" 万元");
				 var qysp = (parseInt(data.TATOLHASRGPERSONSU||0)/parseInt(data.TATOLHASRGSUFLEVERAMOUNT||0)*100 || 0);
				 $("#qysp").text((qysp.toFixed(2)||0)+" %");

				 $("#qbze").text((data.TATOLHASAMOUNT||0)+" 万元");
				 $("#qbzy").text((data.TATOLHASPERSONAMOUNT||0)+" 万元");
				 var qbsp = (parseInt(data.TATOLHASPERSONAMOUNT||0)/parseInt(data.TATOLHASFLEVERAMOUNT||0)*100|| 0);
				 $("#qbsp").text((qbsp.toFixed(2)||0)+" %");

				 //$("#followChemeLink").html(structSchemeLink(data.FLINK));
				 //$("#followChemeLink").html(msg.baseModel.followChemeLink?'<a href="files/数据表.doc">跟投方案下载链接</a>':"");
				 if(data.FLINK){
					var _temp = '<div style="color:red;">温馨提示：请在汇款后下载以上跟投协议，并填写个人信息部分，交至事业部/城市公司财务处核对，由人力统一盖章；或按《募集信息》要求执行。</div>';
 					$("#protocal_info").html(structSchemeLink(data.FLINK)+_temp);
				}else{
					$("#protocal_info").html("");
				}



			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function structSchemeLink(_str){
	var _linkArr = [];
	var _htmlStr = "";
	if(_str && _str.length>0){
		_linkArr = _str.split(";");
		$.each(_linkArr, function(ind, val){
			_htmlStr += '<div><a href="<?php echo site_url()?>fileFolder/'+val+'">'+(ind+1)+'、'+val+'</a></div>';
		});
	}
	return _htmlStr;
}

function getForceList(){
	var ctx="<?php echo site_url();?>";
	var projectId=getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'/Follower/getFollowerListWithProjectID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
		},
		success:function(msg){
			if(msg.success){
				$("#forceTbody").empty();
				if(msg.data && msg.data.length > 0){
					$.each(msg.data, function(ind, val){
						var tempHtml = 
							'<tr><td height="30">'+(ind+1)+'</td>'+
								'<td>'+val.FNAME+'</td>'+
								'<td>'+(val.FSTATE||"")+'</td>'+
								'<td>'+(val.FDUTY||"")+'</td>'+
								'<td>'+val.FTOPLIMIT+'</td>'+
								'<td>'+val.FDOWNLIMIT+'</td>'+
								// '<td>'+(val.remark||"")+'</td></tr>';
								'<td></td></tr>';
						 $("#forceTbody").append(tempHtml);
					});
				}
			
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function getNewsList(){
	var ctx="<?php echo site_url();?>";
	var projectId=getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'News/getNewListProjectID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'uid':"<?php echo $uid; ?>"
		},
		success:function(msg){
			if(msg.success){
				newsInfo = msg.data;
			}else{
				alert(msg.error);
			}
			loadNewsList();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function loadNewsList(){
	$("#newsTbody").empty();
	var ctx="<?php echo site_url();?>";
	if(newsInfo && newsInfo.length > 0){
		var tempHtml = "";
		$.each(newsInfo, function(ind, val){
			tempHtml +=
			'<tr><td height="30">'+(ind+1)+'</td>'+
				'<td><a href="'+ctx+'home/index/newsDetail?newsId='+val.FID+'">'+val.FTITLE+'</a></td>'+
				'<td>'+(new Date(val.FRELEASEDATE)).format('yyyy-MM-dd')+'</td>'+
				'<td>'+val.FUSERNAME+'</td></tr>';
		});
		$("#newsTbody").html(tempHtml);
	}
}

</script>
</body>
</html>