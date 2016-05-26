<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>认购申请</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/subscribeApply.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>

</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<!-- <div id="header">
	<div id="topLayer">
		<div id="logo"></div>
		<div id="loginer"><a href="#">登录后台</a> | <a href="#">当前登录人</a></div>
		<div id="navigation">
			<ul><li ind="4">帮助中心</li>
				<li ind="3">跟投制度</li>
				<li ind="2">个人中心</li>
				<li ind="1" class="focusOn">跟投项目信息</li>
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
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 认购申请</div>
	<div id="protocalView">跟投详细信息和跟投协议相关内容请下载附件查看。</div>
	<div id="protocalOperate">
		<input id="agreeCK" type="checkbox" />
		<label for="agreeCK">同意协议</label>
		<a href="#" class="downProtocal" id="downLoadProtocal">下载协议</a>
	</div>
	<div id="projectInfo" style="display:none;">
		<table border="0" width="100%"><tr>
			<td class="titleTd" width="35%">项目名称:</td>
			<td id="proNameTd"></td>
		</tr><tr style="display:none;">
			<td class="titleTd">项目公司:</td>
			<td id="proCompayTd"></td>
		</tr><tr id="leverSelRow">
			<td class="titleTd">杠杆比例:</td>
			<td><select id="leverSel">
				<option value="1">1:1</option>
				<option value="2">1:2</option>
				<option value="3">1:3</option>
			</select></td>
		</tr><tr>
			<td class="titleTd">认购下限:</td>
			<td><span id="downLimitInp">0</span> (万元)</td>
		</tr><tr>
			<td class="titleTd">认购上限:</td>
			<td><span id="upLimitInp">0</span> (万元)</td>
		</tr><tr>
			<td class="titleTd">认购金额:</td>
			<td><input id="subMoneyInp" class="inpSTY" value="0" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />&nbsp;(万元)</td>
		</tr><tr id="leverageRow">
			<td class="titleTd">杠杆金额:</td>
			<td><input id="levMoneyInp" class="inpSTY readonly" value="0" readonly />&nbsp;(万元)</td>
		</tr><tr>
			<td class="titleTd">认购总额（含杠杆）:</td>
			<td><input id="totalInp" class="inpSTY readonly" value="0" readonly />&nbsp;(万元)</td>
		</tr>
		<tr>
			<td class="titleTd">分红账号:</td>
			<td><select id="bonusIdInp" class="selectSTY">
				<option value="6226 3654 1231 238">6226 3654 1231 238</option>
			</select></td>
		</tr>
		
		<!--tr id="remissionCountTr">
			<td class="titleTd">可用豁免次数:</td>
			<td>
				<input disabled="disabled" id="remissionCount" class="inpSTY readonly" />
			</td>
		</tr-->
		
		<tr>
			<td></td>
			<td height="30" valign="top">
				<span style="font-size:0.9em;"><a id="addBonusBtn" href="javascript:void(0)" style="font-size:0.9em; color:grey">添加分红帐号</a></span>
			</td>
		</tr>
		<tr>
			<td colspan="2"  style="text-align: center;"> 
				<div style="height: 28px;">
					<button id="submitBtn"></button>
					<button id="remissionSumbitBtn">豁免认购</button>
				</div>
			</td>
			<!-- 
			<td style="text-align: right;"><button id="submitBtn"></button></td>
			<td style="text-align: left;"><button id="remissionSumbitBtn">豁免认购</button></td>
			 -->
		</tr>
		</table>
	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	
	// 导航下标
var naviInd = "1";
var proId = "-1";
var forceList = null;
var currProDetail = null;
var currscheDetail = null;
var forceObj = null;
var bankList = null;
var topLimitVal = 0;
var downLimitVal = 0;
var uid ="<?php echo $uid ?>";
$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	proId = getReqParam("projectId");
}

function initListeners(){
	// initHeaderListeners();

	$("#agreeCK").click(function(){
		$("#projectInfo").toggle();
	});


	$("#downLoadProtocal").click(function(){
		var ctx="<?php echo site_url();?>";
		///var projectId=getReqParam('projectid');
		$.ajax({
			type:'post',//可选get
			url:ctx+'/FollowScheme/getFollowShemeListWithProjectID',
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			cache:false,
			data:{'projectId':proId},
			success:function(msg){
				if(msg.success){
					var data = msg.data[0].FLINK;
					//var fileList = data.split(";");
					showProtocalList(data);
				}else{
					alert(msg.error);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
			}
		});
		
	});

	$("#submitBtn").click(function(){
		submitFunc(false);
	});
	$("#remissionSumbitBtn").click(function(){
		submitFunc(true);
	});

	$("#subMoneyInp").blur(function(){

		var leverVal = parseInt($(this).val()*$("#leverSel").val());
		var totalVal = leverVal + parseInt($(this).val());
		$("#levMoneyInp").val(leverVal);
		$("#totalInp").val(totalVal);

	});
	$("#leverSel").change(function(){
		/*if($(this).val() == "0"){
			$("#levMoneyInp").val("0");
			topLimitVal = topLimitVal*5;
			downLimitVal = downLimitVal*5;
		}else{
			$("#levMoneyInp").val($("#subMoneyInp").val()*4);
			topLimitVal = topLimitVal/5;
			downLimitVal = downLimitVal/5;
		}

		$("#levMoneyInp").val($("#subMoneyInp").val()*$("#leverSel").val());

		$("#upLimitInp").text((topLimitVal));
		$("#downLimitInp").text((downLimitVal));*/
	});

	$("#addBonusBtn").click(function(){
		$(this).attr("href","<?php echo site_url(); ?>home/index/personalInfo?projectId="+getReqParam('projectId'));
	})
}

function showProtocalList(protocalList){
	//整个页面的宽高
	var pageWidth=document.body.scrollWidth;
	var pageHeight=document.body.scrollHeight;
	//获取页面的可视区域高度和宽度
	var viewHeight=document.documentElement.clientHeight;
	var viewWidth=document.documentElement.clientWidth;
	
	var maskDiv = document.createElement("div");
	maskDiv.id = "maskLayer";
	maskDiv.style.height = viewHeight + "px";
	maskDiv.style.width = pageWidth + "px";
	document.body.appendChild(maskDiv);
	
	var addPage = document.createElement("div");
	addPage.id = "addPage";
	addPage.innerHTML = generatePage(protocalList);
	document.body.appendChild(addPage);
	//获取新增页面的宽高
	var addPageHeight = addPage.offsetHeight;
	var addPageWidth = addPage.offsetWidth;
	addPage.style.left = pageWidth/2 - addPageWidth/2 + "px";
	//addPage.style.top = viewHeight/2 - addPageHeight/2 + "px";
	addPage.style.top = "350px";

	$("#protocalListCloseBtn").click(function(){
		closeProtocalListPage();
	});
}

function closeProtocalListPage(){
	$("#addPage").remove();
	$("#maskLayer").remove();
}

function generatePage(protocalList){
	var result = "<div id='protocalListBody'>" +
					"<div id='protocalListTitle'>协议下载</div>" +
					"<div id='protocalListCloseBtn'>关闭</div>" +
					"<ul>" + 
						generateProtocalList(protocalList);
					"</ul>" + 
				"</div";
	return result;
}

function generateProtocalList(protocalList){
	var result = "";
	if (protocalList == null) 
	{
		result = "<li><a href='#'>没有可下载的协议!</a></li>" ;
		return result;
	}
	protocalArr = protocalList.split(";");
	var ctx="<?php echo site_url();?>";
	var upload_link = ctx+"fileFolder/";
	if(protocalArr && protocalArr.length > 0){
		for(var i = 0; i < protocalArr.length; i++){
			result = result + "<li>" + 
								'<a href="'+upload_link+protocalArr[i]+'">' + (i + 1 + "、 ") + protocalArr[i] + "</a>" +
						"</li>";
		}
	}else{
		result = "<li><a href='files/201_0.doc'>1、 201委托投资协议书（修订稿）141216.doc</a></li>" +
				"<li><a href='files/202_0.doc'>2、 202接受投资委托情况说明书及确认书（修订稿）141216.doc</a></li>" +
				"<li><a href='files/203_0.doc'>3、 203杠杆借款协议（修订稿）141216.doc</a></li>";
	}
	
	return result;
}

function initPages(){
	getProDetai();
	getProScheme();
}

function getProDetai(){
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url: ctx+'/Project/getProjectDetail?time=' + new Date().getTime(),
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				if(msg.data){
					currProDetail = msg.data[0];
					$("#proNameTd").text(currProDetail.FNAME);
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function getProScheme(){
	/*$.ajax({
		type:'post',//可选get
		url:'../FollowSchemeController/getSchemeByProjectId.action?time=' + new Date().getTime(),
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{'projectId':proId},
		success:function(msg){*/
			getForceData();
			getBankData();
			/*if(msg.success){
				if(msg.baseModel){
					currscheDetail = msg.baseModel;
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	});*/
}

function getForceData(){
	var ctx = "<?php echo site_url(); ?>";
	$.ajax({
		
		type:'post',//可选get
		url:ctx+'Follower/getFollowerWithProjectIDAndUserID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{'projectId':getReqParam('projectId'),'uid':"<?php echo $uid ?>"},
		success:function(msg){
			if(msg.success){
				forceList = msg.data[0];
				loadLimitData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadLimitData(){
	//$("#proNameTd").text(currProDetail.FNAME);
	// $("#proCompayTd").val(currProDetail);
	/*if(isForcePerson()){
		topLimitVal = parseInt(forceObj.toplimit);
		downLimitVal = parseInt(forceObj.downlimit);
		$("#leverSelRow").show();
		$("#leverageRow").show();
	}else{
		topLimitVal = (currscheDetail.maxamount);
		downLimitVal = (currscheDetail.minamount);
		$("#leverSelRow").hide();
		$("#leverageRow").hide();
	}*/
	$("#upLimitInp").text((forceList.FTOPLIMIT));
	$("#upLimitInp").val((forceList.FTOPLIMIT));
	$("#downLimitInp").text((forceList.FDOWNLIMIT));
	$("#downLimitInp").val((forceList.FDOWNLIMIT));
}

function getBankData(argument) {
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'bankInfo/getPersonBankInfo?time=' + new Date().getTime(),
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{
			uid:"<?php echo $uid ?>",
		},
		success:function(msg){
			if(msg.success){
				bankList = msg.data;
				loadBankData();
				//userInfo = msg.baseModel;
				//loadRemissionInfo(msg.baseModel);
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadRemissionInfo(userInfo){
	/*if((userInfo.remissionCount - userInfo.usedRemissionCount) > 0){
		$("#remissionCountTr").css("display", "table-row");
		$("#remissionCountTr #remissionCount").val(userInfo.remissionCount - userInfo.usedRemissionCount);
		$("#remissionSumbitBtn").css("display","inline-block");
	}*/
}

function loadBankData(){
	var tempHtml = "";
	if(bankList && bankList.length >0){
		$("#bonusIdInp").empty();
		$.each(bankList, function(ind, val){
			tempHtml +=
				'<option value="'+val.FID+'">'+val.FBANKNO+'</option>';
		});
		$("#bonusIdInp").html(tempHtml);
	}else{
		tempHtml = '<option value=""></option>';
		$("#bonusIdInp").html(tempHtml);
	}
}

function isForcePerson(){
	var bool = false;
	$.each(forceList, function(ind, val){
		if(val.remark == currAccountName){
			forceObj = val;
			bool = true;
		}
	});
	return bool;
}

function submitFunc (isRemissionSubscribe) {
	var FAMOUNT = parseInt($("#subMoneyInp").val());
	var FLEVERAMOUNT = parseInt($("#levMoneyInp").val());
	var FBANKID = $("#bonusIdInp").val();
	var FLEVERRATIO = $("#leverSel").val() ;
    var topLimitVal =  parseInt($("#upLimitInp").val()) ;
	var downLimitVal =  parseInt($("#downLimitInp").val()) ;

	_subMoney = parseInt(FAMOUNT) + parseInt(FLEVERAMOUNT);
	//var _bankNo = $("#bonusIdInp").val();
	/*if(isRemissionSubscribe){
		if(!window.confirm("您的总的可用豁免次数为：" + (userInfo.remissionCount - userInfo.usedRemissionCount) +"，您确认使用吗？")){
			return false;
		}
	}else{
		if(isForcePerson()){
			if($("#leverSel").val() == "4"){
				if(_subMoney > topLimitVal){
					alert("总认购金额超过上限!");
					return false;
				}else if(_subMoney < downLimitVal){
					alert("总认购金额低于下限!");
					return false;
				}
			}else{
				if(_subMoney < downLimitVal){
					alert("总认购金额低于下限!");
					return false;
				}else if(_subMoney > topLimitVal){
					alert("总认购金额超过上限!");
					return false;
				}
			}
		}else{
			if(_subMoney > topLimitVal){
				alert("总认购金额超过上限!");
				return false;
			}else if(_subMoney < downLimitVal){
				alert("总认购金额低于下限!");
				return false;			
			}
		}*/
		if(_subMoney > topLimitVal){
				alert("总认购金额超过上限!");
				return false;
			}else if(_subMoney < downLimitVal){
				alert("总认购金额低于下限!");
				return false;			
			}
		if(!FBANKID){
			alert("请选择银行帐号!");
			return false;	
		}
		if(FAMOUNT <= 0){
			alert("请输入正确认购金额!");
			return false;
		}
	//}
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',
		url:ctx+'Subscription/addSubscribe',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:{
			"FUSERID":uid,
			"FPROJECTID":getReqParam('projectId'),//"024ec88b-188b-4ada-a807-1f79454eeea3",
			"FAMOUNT":FAMOUNT,
			"FLEVERAMOUNT":(FAMOUNT*FLEVERRATIO||0),
			"FCONFIRMAMOUNT":FAMOUNT,
			"FLEVERCONFIRMAMOUNT":(FAMOUNT*FLEVERRATIO||0),
			"FBANKID":FBANKID,
			"FLEVERRATIO":FLEVERRATIO
			//"isRemissionSubscribe":isRemissionSubscribe
		},
		success:function(msg){
			alert("认购成功！");
			location.href = "<?php echo site_url()?>home/index/projectList?query=0#1";
			//history.go(-1);

		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        	alert("认购失败！");
        }
	});
}
</script>
</body>
</html>