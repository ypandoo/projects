<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 项目管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script> -->
<script type="text/javascript" src="../plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="../plugins/ajaxfileupload.js"></script>

<style type="text/css">
.displayNone{display: none;}

#main_content{min-height: 400px; width: 1240px;margin: 10px auto 20px auto;overflow: hidden;}
#main_content #navLayer{padding: 12px 0px;overflow: hidden;}
#main_content #navLayer #navProLayer{float:left;}
#main_content #navLayer #backLayer{float:right;margin: 0px 20px 0px;}
#main_content .frameSTY{float: left;border:1px solid #D8D5D5;min-height:400px;}
#main_content #leftLayer{width: 200px;min-height:460px;margin: 0px -1px 0px 0px;position: relative;background: #F0F0F0;clear: both;}
#main_content #leftLayer .leftTitle{text-align: center;height: 40px;line-height: 40px;color: #000;border-bottom: 1px solid #B4B4B4;font-weight: bold;font-size: 1.2em;
	/* Firefox */
	/*background-image: -moz-linear-gradient(top, #F8F5F3, #1255BB);*/
	/* Saf4+, Chrome */
	/*background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #F8F5F3), color-stop(1, #1255BB));*/
	/* IE*/
	/*filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F8F5F3', endColorstr='#1255BB', GradientType='0');*/
}
#main_content #leftLayer .naviUl{width: 100%;list-style: none;margin: 0px;padding: 0px;}
#main_content #leftLayer .naviUl li{text-align: center;height: 35px;line-height: 35px;border-bottom: 1px solid #E4E4E4;cursor: pointer;}
#main_content #leftLayer .naviUl .focusOn{background: #FFF;color: #D94026;width: 101%;font-weight: bold;}
#main_content #rightLayer{width: 1000px;padding:10px;min-height: 420px;height: 440px;overflow-y:auto;background: #FFF;}
#main_content #rightLayer table td{font-size: 1em;}
</style>

<script type="text/javascript">

var projectId = null;
var naviVal = null;
var pageHash = null;
var projectName = null;

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	projectId = getReqParam("projectId");
	projectName = getReqParam("projectName");
	naviVal = "projectBasicInfo";
	pageHash = location.hash?location.hash:"#projectBasicInfo";
}

function initListeners(){
	$("#main_content #leftLayer .naviUl li").hover(function(ev){
		$(this).addClass("focusOn");
	},function(ev){
		var v = $(this).attr("val");
		if(v != naviVal)
			$(this).removeClass("focusOn");
	}).click(function(){
		$("#main_content #leftLayer .naviUl li").removeClass("focusOn");
		$(this).addClass("focusOn");
		naviVal = $(this).attr("val");

		loadContentPage();
	});
}

function initPages(){
	if(projectName){
		// 为父页面填充导航项目名称
		$("#navProLayer #pageProName").text(projectName);
	}

	$.ajax({
		type:'post',//可选get
		url:'../UserProjectRelateController/getRelateByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"projectId":projectId},
		success:function(msg){
			if((msg.success && msg.dataDto.length > 0)){
				var permArr = msg.dataDto[0].permissionFlag.split("");
				$("#leftLayer .naviUl li").each(function(ind, val){
					if(ind < permArr.length && permArr[ind] != "0") $(this).removeClass("displayNone");
				});
				var tempStr = "projectBasicInfo";
				if(pageHash){
					tempStr = pageHash.substring(1);
				}
				$("#main_content #leftLayer .naviUl li[val="+tempStr+"]").click();
			}else{
				alert("当前登录用户没有权限!");
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function loadContentPage(){
	location.hash = naviVal;
	var url = naviVal+".jsp";
	$("#rightLayer").load(url);
}
</script>

</head>
<body>
<jsp:include page="header.jsp"></jsp:include>
<div id="main_content">
	<div id="navLayer">
		<div id="navProLayer">当前项目：<span id="pageProName"></span></div>
		<div id="backLayer"><a href="index.jsp"><- 返回项目列表</a></div>
	</div>	
	<div id="leftLayer" class="frameSTY">
		<div class="leftTitle">
			<img src="images/menu_0.png" style="vertical-align:middle;" />&nbsp;&nbsp;管理菜单
		</div>
		<ul class="naviUl">
			<li val="projectBasicInfo" class="focusOn displayNone">基础信息</li>
			<li val="projectNewsInfo" class="displayNone">动态新闻</li>
			<li val="subscribeConfirm" class="displayNone">认购核准</li>
			<li val="payInConfirm" class="displayNone">缴款确认</li>
			<li val="projectBonusInfo" class="displayNone">分红明细</li>
			<li val="specialInfo" class="displayNone">特别跟投</li>
			<li val="dimissionInfo" class="displayNone">离职处理</li>
			<!-- <li val="ognz_info">组织架构设置</li> -->
		</ul>
	</div>
	<div id="rightLayer" class="frameSTY">
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>