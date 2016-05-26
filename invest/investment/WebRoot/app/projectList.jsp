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
<title>项目列表</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>

<style type="text/css">
.btnLayer{float: right;padding-right: 2em;}
.btnLayer div{padding: .7em 1.4em;text-align: center;border: lightgray 1px solid;display: inline-block;border-radius: 5px;font-size: .9em;margin: 0 .3em;cursor: pointer;}
.btnLayer div:hover{color: #D94026;border-color: #D94026;}
.btnSTY{display: inline-block;}

.ui-content{padding: 0em 1em 1em;}
.ui-listview > .ui-li-has-thumb > .ui-btn, .ui-listview > .ui-li-static.ui-li-has-thumb{min-height: 6em;padding-left: 6.5em;}
.ui-listview .ui-li-has-thumb > img:first-child, .ui-listview .ui-li-has-thumb > .ui-btn > img:first-child, .ui-listview .ui-li-has-thumb .ui-li-thumb{top: 1em;left: 1em;}
.ui-listview > li h1, .ui-listview > li h2, .ui-listview > li h3, .ui-listview > li h4, .ui-listview > li h5, .ui-listview > li h6{font-size: .9em;}
.ui-btn{padding: .2em 1em;font-size: .6em;}
.ui-controlgroup{margin: 0;text-align: right;}
.ui-page-theme-a a{font-weight: 100;}

.ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head + body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head + body .ui-btn.ui-btn-a:visited{background-color: #FFFFFF;font-size: .9em;font-weight: 100;text-shadow:none;}
.ui-page-theme-a .ui-btn:hover, html .ui-bar-a .ui-btn:hover, html .ui-body-a .ui-btn:hover, html body .ui-group-theme-a .ui-btn:hover, html head + body .ui-btn.ui-btn-a:hover{color: #000;}
.ui-listview > li p{font-size: .8em;margin: .3em 0;float: left;}
</style>
<script type="text/javascript">
var projectList = null;
var isPerson = "";

$(function(){
	$('body').fontFlex(14, 60, 30);

	$("#proList").on("click", ".subBtn", function(e){
		location.href = "subscribeApply.jsp?proId="+projectList[$(this).attr("ind")].projectId;
		e.stopPropagation();
	});
	$("#proList").on("click", ".detailBtn", function(e){
		location.href = "projectDetail.jsp?proId="+projectList[$(this).attr("ind")].projectId;
		e.stopPropagation();
	});
	$("#proList").on("click", "li", function(){
		location.href = "projectDetail.jsp?proId="+projectList[$(this).attr("ind")].projectId;
	});

	getProjectList();
});
function getProjectList(){
	isPerson = getReqParam("isPerson");
	var str = '[{"name":"userid","value":"张三id"},{"name":"isPerson","value":"'+isPerson+'"},{"name":"type","value":"1"},{"name":"releaseStartDate","value":""},{"name":"releaseEndDate","value":""},{"name":"projectStatus","value":"-1"},{"name":"projectName","value":""}]';
	$.ajax({
		type:'post',//可选get
		url:'../ProjectBasicController/getProjectList.action?time=' + new Date().getTime(),
		cache:false,
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		contentType: "application/json; charset=utf-8", 
		data:str,
		success:function(msg){
			debugger;
			if(msg.success){
				if(msg.dataDto && msg.dataDto.length > 0){
					projectList=msg.dataDto;
					loadProjectData();
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
function loadProjectData(){
	$("#proList").empty();
	if(projectList && projectList.length > 0){
		var tempHtml = "";
		$.each(projectList, function(ind, val){
			var tempImg = "./images/254_142.png";
			var tempBtn = "";
			if(val.projectImages){
				tempImg = "../images/projectFiles/"+val.projectImages;
			}
			if((val.isPurchase=="" || val.isPurchase==null || val.isPurchase=="null") 
				&& new Date(val.subscribeStartDate) < new Date() 
				&& new Date(val.subscribeEndDate) > new Date()){
				tempBtn = '<div class="subBtn btnSTY" ind="'+ind+'">认购</div>';
			}
			tempHtml +=
				'<li ind="'+ind+'"><a href="#"><img src="'+tempImg+'">'+
					'<h1>'+val.projectName+'</h1>'+
					'<p>资金募集时间：<br>'+(new Date(val.subscribeStartDate)).format('yyyy-MM-dd')+' 至 '+(new Date(val.subscribeEndDate)).format('yyyy-MM-dd')+'</p>'+
					'<div class="btnLayer">'+tempBtn+
						// '<div class="detailBtn" ind="'+ind+'">详细</div>'+
					'</div>'+
					'</a>'+
				'</li>';
		});
		$("#proList").html(tempHtml);
		// $("#proList").html(tempHtml).trigger('create');
		$('#proList').listview("refresh");
		// $('.btnSTY').button("refresh");
	}
}
</script>
</head>
<body>
<input id="loginInp" type="hidden" value="${loginId}">
<input id="unameInp" type="hidden" value="${loginName}">
<div data-role="page">
	<div data-role="content">
		<ul id="proList" data-role="listview" data-filter="true" data-filter-placeholder="请输入关键字搜索">
			<!-- <li>
				<img src="images/bonus_icon.png">
				<h1>合肥高新项目a</h1>
				<p>资金募集时间：2013-10-10 至 2014-10-10</p>
				<div class="btnGrp" data-role="controlgroup" data-type="horizontal">
					<a href="" data-role="button">详细</a>
					<a href="subscribeApply.html" rel="external" data-role="button">认购</a>
				</div>
				<div class="btnLayer">
					<div class="detailBtn">详细</div>
					<div class="subBtn">认购</div>
				</div>
			</li> -->
		</ul>
	</div>
</div>
</body>
</html>