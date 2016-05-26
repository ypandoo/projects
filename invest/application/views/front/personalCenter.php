<html>
<head>
<title>个人中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/personalCenter.css')?>">


<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>


</head>
<body>
<form id="listform" >
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
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
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 个人中心</div>
	<div id="personalInfo">
		<table class="infoTable" border="0" cellpadding="0" cellspacing="0"><tr>
			<td width="200">个人跟投总额(万元)</td>
			<td width="200">个人认购总额(万元)</td>
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
				<span class="titleSTY">未完成跟投项目</span>
				<a class="moreSTY" href="<?php echo site_url(); ?>home/index/projectList?query=2&isPerson=yes">更多 》</a>
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
		<!--div id="newsInfo">
			<div class="newsTitle"><span class="titleSTY">动态新闻</span><a class="moreSTY" href="newsList.jsp">更多 》</a></div>
			<div class="newsList">
				<!-- <div class="listSTY">
					<a href="#">2014-07-19&nbsp;&nbsp;新安集团钢筋战略采购招标新安集团钢筋战略采购招标</a>
				</div>
			</div>
		</div> -->
	</div>
	<div id="completedInfo">
		<div class="compTitle">
			<span class="titleSTY">已完成认购</span>
			<a class="moreSTY" href="<?php echo site_url() ?>home/index/completed">更多 》</a>
		</div>
		<div class="compList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td rowspan="2" width="40" height="34">序号</td>
				<td rowspan="2" width="150">跟投项目</td>
				<td colspan="2">认购额度</td>
				<td colspan="2" class="displayNone">调整额度</td>
				<!--td colspan="2">认购金额</td-->
				<td rowspan="2">缴款确认金额(万元)</td>
				<td rowspan="2">已分红总额(万元)</td>
				
				<td rowspan="2"  width="180" >说明</td>
				<td rowspan="2"  width="60" >操作</td>
			</tr><tr>
				<td width="140">出资金额(万元)</td>
				<td width="140">杠杆金额(万元)</td>
				<td width="110" class="displayNone">出资金额(万元)</td>
				<td width="110" class="displayNone">杠杆金额(万元)</td>
				<!--td width="140">出资金额(万元)</td>
				<td width="140">杠杆金额(万元)</td-->
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
			<span class="titleSTY">缴款确认</span>
			<a class="moreSTY" href="<?php echo site_url() ?>home/index/payInDetail">更多 》</a>
		</div>
		<div class="payInList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td width="60" height="34">序号</td>
				<td width="280">跟投项目</td>
				<td width="170">认购金额(万元)</td>
				<td>缴款批次</td>
				<td width="170">缴款日期</td>
				<td width="150">缴款金额<br>(万元)</td>
			</tr></thead>
			<tbody id="payInTbody">
				<tr><td colspan="6" height="70" valign="middle">
						<img src="<?php echo site_url().'application/views/front/images/tips.png';?>" align="absmiddle">&nbsp; 对不起，暂无相关数据
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
			<span class="titleSTY">分红明细</span>
			<a class="moreSTY" href="<?php echo site_url() ?>home/index/bonusDetail">更多 》</a>
		</div>
		<div class="bonusList">
			<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr>
				<td width="60" height="34">序号</td>
				<td width="280">跟投项目</td>
				<td width="170">认购金额(万元)</td>
				<td width="170">分红日期</td>
				<td width="150">分红金额<br>(万元)</td>
				<td width="60">分红批次</td>
				<!--td>备注</td-->
			</tr></thead>
			<tbody id="bonusTbody">
				<tr><td colspan="7" height="70" valign="middle">
						<img src="<?php echo site_url().'application/views/front/images/tips.png';?>" align="absmiddle">&nbsp; 对不起，暂无相关数据
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
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "2";
// 个人统计信息
var personalInfoObj = {};
// 跟投项目内容列表
var projectList = [];
// 新闻内容列表
var newsList = [];
// 已完成认购列表
var completedList = [];
// 缴款确认列表
var payInList = [];
// 分红明细列表
var bonusList = [];

var uid ="<?php echo $uid ?>";

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	$("#isPerson").val("yes");

}

function initListeners(){
	initHeaderListeners();
}

function initPages(){
	getPersonalInfo();
	getProjectInfo();
	//getNewsInfo();
	getCompletedInfo();
	getPayInInfo();
	getBonusInfo();
}

function getPersonalInfo(){
	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'user/getUserBaseInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{uid:uid},
		success:function(msg){
			if(msg.success){
				if(msg.data ){
					personalInfoObj = msg.data;
					loadPersonalInfo();
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loadPersonalInfo () {
	if(personalInfoObj){
		var personamount = parseInt(personalInfoObj.FTOTALAMOUNT||0) - parseInt(personalInfoObj.FTOTALFLEVERAMOUNT||0)
		$("#amountTotalTd").text("￥ "+(personalInfoObj.FTOTALAMOUNT||0));
		$("#confirmAmountTd").text("￥ "+personamount);
		$("#leverageAmountTd").text("￥ "+(personalInfoObj.FTOTALFLEVERAMOUNT||0));
		$("#bonusAmountTd").text("￥ "+(personalInfoObj.FTOTALBONUSAMOUNT||0));
		$("#proCountTd").html(personalInfoObj.FPROJECTCOUNT||0);
	}
}

// 未完成列表
function getProjectInfo(){
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'project/getUserAllFollowProject',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			begin: 0,
			count: 2,
			uid: uid,
			searchname: "",
			subscribeStartDate: "",
			subscribeEndDate:"",
			queryType: 2,	
		},
		success:function(msg){
			if(msg.success){
				projectList = msg.data;
				loadProjectInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadProjectInfo(){
	$("#projectList .proList").empty();
	if(projectList && projectList.length > 0){
		var tempHtml = "";
		var tempPayDate;
		var tempSubDate;
		var tempImg = "<?php echo site_url() ?>images/default.jpg";
		$.each(projectList, function(ind, val){
		if(new Date(val.FSUBSCRIBESTARTDATE)<=new Date() && new Date(val.FSUBSCRIBEENDDATE)>=new Date())
		{
			tempPayDate = "";
			tempSubDate = "";
			tempImg = "./images/80_80.png";
			/*if(val.payStartDate){
				tempPayDate = (new Date(val.payStartDate)).format('yyyy-MM-dd');
			}
			if(val.subscribeStartDate){
				tempSubDate = (new Date(val.subscribeStartDate)).format('yyyy-MM-dd');
			}*/
			if(val.ImageName){
				tempImg = "<?php echo site_url() ?>images/"+val.ImageName;
			}
			/*
			FHDAMOUNT: ""
FHDSUAMOUNT: null
FISSU: 1
FPAYENDDATE: "2016-01-27"
FPAYSTARTDATE: "2016-01-27"
FPROJECTID: "34"
FPROJECTNAME: "new1"
FREGIONAMOUNT: "10"
FREGIONSUAMOUNT: null
FSUBSCRIBEENDDATE: "2016-01-27"
FSUBSCRIBESTARTDATE: "2016-01-27"
			*/
			tempHtml +='<div class="listSTY">'+
							'<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">'+
								'<tr>'+
									'<td colspan="2" height="90" align="left">'+
										'<a href="<?php echo site_url() ?>home/index/projectDetail?projectId='+val.FPROJECTID+'">'+
										'<img src="'+tempImg+'" width="80" height="80" style="border-radius: 0px;"></a>'+
									'</td>'+
								'</tr>'+
								'<tr>'+
									'<td colspan="2" class="proName"><a href="<?php echo site_url() ?>home/index/projectDetail?projectId='+val.FPROJECTID+'">'+val.FPROJECTNAME+'</a></td>'+
					/*'</tr><tr>'+
						'<td colspan="2">'+(val.groundPosition||"")+'</td>'+
					'</tr><tr>'+
						'<td>员工跟投总额:</td>'+
						'<td>'+(val.followAmount||0)+' 万元</td>'+
					'</tr><tr>'+
						'<td>认购开始时间:</td>'+
						'<td>'+tempSubDate+'</td>'+
					'</tr><tr>'+
						'<td>付款开始时间:</td>'+
						'<td>'+tempPayDate+'</td>'+*/
							'</tr></table></div>';
			}
		})
		$("#projectList .proList").html(tempHtml);
	}
}

/*function getNewsInfo (argument) {
	var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"'+userid+'","pageSize":"'+9+'","projectName":""}',
		success:function(msg){
			if(msg.success){
				newsList=msg.dataDto;
				loadNewsInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadNewsInfo(){
	$("#newsInfo .newsList").empty();
	if(newsList && newsList.length > 0){
		var tempHtml = "";
		$.each(newsList, function(ind, val){
			tempHtml +=
				'<div class="listSTY">'+
					'<a href="./newsDetail.jsp?newsId='+val.newsId+'">'+formatDate(val.releaseDate)+'&nbsp;&nbsp;'+val.title+'</a>'+
				'</div>';
		})
		$("#newsInfo .newsList").html(tempHtml);
	}
}*/

function getCompletedInfo(){
	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Subscription/getHasSubscribe',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"uid":uid},
		success:function(msg){
			if(msg.success){
				completedList = msg.data;
				loadCompletedInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loadCompletedInfo(){
	$("#compTbody").empty();
	if(completedList && completedList.length > 0){
		var tempHtml = "";
		var bNotify = 0;
		$.each(completedList, function(ind, val){

			if (val.FSTATE == 0) 
			{
				if (parseInt(val.FAMOUNT) == parseInt(val.FCONFIRMAMOUNT) ) 
				{

				}
				else
				{
					bNotify = 1;
				}
			};
			tempHtml +=
				'<tr><td height="25">'+(ind+1)+'</td>'+
					'<td>'+(val.FNAME||"")+'</td>'+
					'<td>'+(val.FAMOUNT||0)+'</td>'+
					'<td>'+(val.FLEVERAMOUNT||0)+'</td>'+
					'<td class="displayNone">'+(val.adjustamt||0)+'</td>'+
					'<td class="displayNone">'+(val.adjustLeverageAmt||0)+'</td>'+
					'<td>'+(val.TOTALFPAYAMOUNT||0)+'</td>';

			if (bNotify == 1)
			{
				tempHtml +=
				'<td>'+(val.TOTALFBONUSAMOUNT||0)+'</td>'+
				'<td style="color:red">'+'认购申请金额'+val.FCONFIRMAMOUNT+'万元与<br>缴款确认金额'+val.FAMOUNT+'万元不符！</td>'+
				'<td><a style="cursor:pointer" onclick="confirmAdjust('+val.FID+')">确认</a>'+'</td>'+
				'</tr>';
			}
			else
			{
				tempHtml +=
				'<td>'+(val.TOTALFBONUSAMOUNT||0)+'</td>'+
				'<td>'+' '+'</td>'+
				'<td>'+'</tr>';
			}		
			//'<td>'+(val.TOTALFBONUSAMOUNT||0)+'</td>'+
			//'<td>'+(val.confirmationPayment||0)+'</td>'+
			// '<td width="150">'+formatMillions(val.bonusAmount)+'</td>'+

		})
		$("#compTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="9" height="70" valign="middle">'+
				'<img src="<?php echo site_url(); ?>application/views/front/images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#compTbody").html(tempHtml);
	}
}

function confirmAdjust(ind)
{
	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Subscription/updateSubscribe',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"FID":ind,
			"FSTATE": 1
		},
		success:function(msg){
			if(msg.success){
				alert('确认成功！');
				window.location.reload();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function getPayInInfo() {
	var _obj = '{'+
			//"projectId":"'+projectId+'",'+
			// '"projectName":"'+_searText+'",'+
			// '"startDate":'+_sDate+','+
			// '"endDate":'+_eDate+','+
			// '"piId":"",'+
			// '"piTimes":0,'+
			// '"subscribeAmt":0,'+
			// '"piDate":"",'+
			// '"piAmt":0,'+
			// '"numberCode":"",'+
			// '"uname":"'+_searText+'",'+
			'"userId":"'+currUser+'",'+
			'"startPage":"'+0+'",'+
			'"endPage":"'+10+'"'+
			'}';
	$.ajax({
		type:'post',//可选get
		url:'../PayInDetailController/selectListByDetail.action',
		contentType: "application/json; charset=utf-8",
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				payInList = msg.dataDto;
				loadPayInInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadPayInInfo(){
	$("#payInTbody").empty();
	if(payInList && payInList.length > 0){
		var tempHtml = "";
		$.each(payInList, function(ind, val){
			tempHtml +=
			'<tr><td width="50" height="35">'+(ind+1)+'</td>'+
			'<td>'+(val.projectName||"")+'</td>'+
			'<td>'+(val.subscribeAmt||0)+'</td>'+
			'<td>'+(val.piTimes||0)+'</td>'+
			'<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+(val.piAmt||0)+'</td></tr>';

				// tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
				// '<td>'+val.uname+'</td>'+
				// '<td>'+(val.service||"")+'</td>'+
				// '<td>'+val.subType+'</td>'+
				// '<td>'+formatMillions(val.subscribeAmt)+'</td>'+
				// '<td>'+val.piTimes+'</td>'+
				// '<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
				// '<td>'+formatMillions(val.piAmt)+'</td>'+
				// '<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#payInTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="6" height="70" valign="middle">'+
				'<img src="<?php echo site_url() ?>application/views/front/images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#payInTbody").html(tempHtml);
	}
}

function getBonusInfo(){
	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'BonusRecord/getUserBonusRecord',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"startPage":0,
			"endPage":10,
			"startDate":"",
			"endDate":"",
			"projectName":"",
			"uid":uid,
			"projectId":""
		},
		success:function(msg){
			if(msg.success){
				bonusList = msg.data;
				loadBonusInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadBonusInfo(){
	$("#bonusTbody").empty();
	if(bonusList && bonusList.length > 0){
		var tempHtml = "";
		$.each(bonusList, function(ind, val){
			tempHtml +=
				'<tr><td height="25">'+(ind+1)+'</td>'+
					'<td>'+(val.FNAME||"")+'</td>'+
					'<td>'+(val.subscribeAmount||0)+'</td>'+
					'<td>'+(new Date(val.FBONUSDATE)).format('yyyy-MM-dd')+'</td>'+
					'<td>'+(val.FBONUSAMOUNT||0)+'</td>'+
					'<td>'+(val.FBONUSTIMES||0)+'</td>'+
				'</tr>';
		})
		$("#bonusTbody").html(tempHtml);
	}else{
		var tempHtml = 
			'<tr><td colspan="7" height="70" valign="middle">'+
				'<img src="<?php echo site_url() ?>application/views/front/images/tips.png" align="absmiddle">&nbsp; 对不起，暂无相关数据'+
			'</td></tr>';
		$("#bonusTbody").html(tempHtml);
	}
}

function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
</script>
</body>
</html>