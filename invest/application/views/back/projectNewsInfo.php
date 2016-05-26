
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 新闻列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>

<style type="text/css">
body{font-size: 12px;}
#rightLayer #searchLayer{text-align: right;margin: 10px auto;}
.searDate{float: left;}
#rightLayer #searchLayer .btnSTY{margin: 0 3px;}
#rightLayer #searchLayer input{height: 25px;padding:0px 5px;}
#rightLayer #addBtnLayer{text-align: right;margin: 5px 0px;}
#rightLayer #newsTable{border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;}
#rightLayer #newsTable thead{background: url("<?php echo site_url() ?>"application/views/front/images/thead_bg.png);}
#rightLayer #newsTable td{text-align: center;border: 1px solid #e8e8e8;}
#rightLayer #newsTable input{width: 80px;height: 25px;}
</style>

<script type="text/javascript">
var newsList = null;
var uid =$('#uid').attr('uid');
$(function(){
	initNewsParams();
	initNewsListeners();
	getNewsData();
});
function initNewsParams(){
	
}

function initNewsListeners(){
	$("#relStartInp").datetimepicker({format:'Y-m-d',timepicker:false});
	$("#relEndInp").datetimepicker({format:'Y-m-d',timepicker:false});
	$("#searchTextBtn").click(getNewsData);
	$("#clearTextBtn").click(function(){
		$("#relStartInp").val("");
		$("#relEndInp").val("");
		$("#titleInp").val("");
		getNewsData();
	});
	$("#addNewsBtn").click(function(){
		// location.hash = "";
		var ctx="<?php echo site_url();?>";
		location.href = "/back/index/newsEditor?projectId="+getReqParam('projectId')+'&uid='+uid;
	});
	$("#newsTbody .delBtn").live("click",delNews);
}

function getNewsData(){
	var searText = $("#titleInp").val();
	var sDate = $("#relStartInp").val();
	var eDate = $("#relEndInp").val();

	newsList = [];


	//
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'News/getBackNewListProjectID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		//begin=0&count=2&uid=test&projectId=123
		data:{//begin: 0,
			//count:2,
		    //uid: 'test',
		    projectId: getReqParam('projectId')}, //getReqParam('projectId')},
		success:function(msg){
			if(msg.success){
				newsList=msg.data;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
	    	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
	    }
	});


	/*$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'title':searText,
			'releaseBegin':sDate,
			'releaseEnd':eDate
		},
		success:function(msg){
			if(msg.success){
				newsList = msg.dataDto;
			}else{
				alert(msg.error);
			}
			loadNewsData();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});*/
}

function loadNewsData(){
	$("#newsTbody").empty();
	if(newsList && newsList.length > 0){
		var tempHtml = "";

		//{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}
		$.each(newsList, function(ind, val){
			var rDate = new Date(val.FRELEASEDATE);
			/*tempHtml += '<tr><td height="40">'+(ind+1)+'</td>'+
				'<td>'+val.title+'</td>'+
				'<td>'+val.projectName+'</td>'+
				'<td>'+rDate.format('yyyy-MM-dd')+'</td>'+
				'<td>'+val.authorName+'</td>'+
				'<td>'+
					'<a href="newsEditor.jsp?newsId='+val.newsId+'&proId='+projectId+'">编辑</a> | '+
					'<a class="delBtn" href="javascript:void(0)" nid="'+val.newsId+'">删除</a>'+
				'</td></tr>';*/
			tempHtml += '<tr><td height="40">'+(ind+1)+'</td>'+
				'<td>'+val.FTITLE+'</td>'+
				'<td>'+val.FPROJECTNAME+'</td>'+
				'<td>'+rDate.format('yyyy-MM-dd')+'</td>'+
				'<td>'+val.FUSERNAME+'</td>'+
				'<td>'+
					'<a href="newsEditor?newsId='+val.FID+'&projectId='+getReqParam('projectId')+'">编辑</a> | '+
					'<a class="delBtn" href="javascript:void(0)" nid="'+val.FID+'">删除</a>'+
				'</td></tr>';	
		});
		$("#newsTbody").html(tempHtml);
	}
}

function delNews(_ev){
	if(!confirm("确定要删除这条新闻吗？")) return false;
	var _newsId = $(this).attr("nid");
	
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'/news/deleteNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'FID':_newsId
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
			}else{
				alert(msg.error);
			}
			getNewsData();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}
</script>
</head>
<body id="rightLayer">
<!--div id="searchLayer">
	<div class="searDate">发布日期：<input id="relStartInp" readonly />至<input id="relEndInp" readonly /></div>
	<input id="titleInp" placeholder="请输入新闻标题" />
	<button id="searchTextBtn" class="btnSTY">搜索</button>
	<button id="clearTextBtn" class="btnSTY">清空</button>
</div-->
<div id="addBtnLayer"><button id="addNewsBtn">发布新闻</button></div>
<table id="newsTable" border="1" width="100%"><thead><tr>
	<td height="34" width="50">序号</td>
	<td width="300">标题</td>
	<td width="220">所属项目</td>
	<td width="120">发布日期</td>
	<td width="120">发布人</td>
	<td>操作</td>
</tr></thead>
<tbody id="newsTbody">
	<!-- <tr><td height="40">1</td>
		<td>合肥高新项目付款对账完成公示</td>
		<td>合肥高新项目</td>
		<td>2014-09-01</td>
		<td>张三</td>
		<td>
			<a href="newsEditor.jsp">编辑</a> | 
			<a href="javascript:void(0)">删除</a>
		</td></tr> -->
</tbody></table>
</body>
</html>