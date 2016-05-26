
<html>
<head>
<title>数据维护系统 - 新闻编辑</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/back/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/back/css/header.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ueditor/ueditor.config.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ueditor/ueditor.all.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ueditor/lang/zh-cn/zh-cn.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>

<style type="text/css">
#rightLayer{font-size: 12px;margin: 0px;}
#editTable{width: 1240px; border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;margin: 30px auto;background: #FFF;}
#editTable td{padding: 5px 10px;border: 1px solid #e8e8e8;}
#editTable .titleTd{text-align: right; width: 100px;}
#editTable .richTd{}
#editTable textarea{height: 400px;width: 100%;}
#editTable input,#editTable select{padding:1px 5px;width: 1080px;margin: 0px;box-sizing: content-box;}
</style>
</head>
<body id="rightLayer">
<table id="editTable" border="1"><tr>
	<td colspan="2"><a id="backBtn" href="javascript:void(0)"><- 返回新闻列表</a></td>
</tr><tr>
	<td class="titleTd">标题</td>
	<td><input id="titleInp" value="" /></td>
</tr><tr>
	<td class="titleTd">所属项目</td>
	<td><input id="projectInp" disabled="true" >
	</input></td>
</tr><tr>
	<td class="titleTd">阅读权限</td>
	<td><select id="permissionSel">
		<option value="1" selected="true">
			公开
		</option>
		<option value="0">
			仅跟投人员可阅读
		</option>
	</select>
	</input></td>
</tr><tr>
	<td class="titleTd">内容</td>
	<td class="richTd">
		<textarea style="display:none;"></textarea>
		<script id="editor" type="text/plain" style="width:100%;height:350px;"></script>
	</td>
</tr><tr>
	<td colspan="2" align="center"><button id="subBtn">提  交</button></td>
</tr></table>
</body>

<script type="text/javascript">
var ctx="<?php echo site_url();?>";
window.UEDITOR_HOME_URL = ctx+"/application/views/plugins/ueditor/";
window.UEDITOR_CONFIG.toolbars = [[
    'undo', 'redo', '|',
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 
    'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    'directionalityltr', 'directionalityrtl', 'indent', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 
    'touppercase', 'tolowercase', '|',
    'link', 'unlink', 'anchor', '|', 
    'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    'simpleupload', 'emotion', 'attachment', '|',
    'inserttable', 'deletetable', 'preview'
]];
var newsId = null;
var newsInfo = null;
var currProId = null;
var ueObj = null;
var projectList = null;

var uid =getReqParam('uid');

$(function(){
	ueObj = UE.getEditor('editor');
	initParams();
	initListeners();

	if (newsId) 
		{
			setTimeout(getNewsInfo, 500);
		}
	else
	{
		setTimeout(getProjectInfo, 500);
	}
	
	// setTimeout(function(){
		//getProjectList();
	// }, 500);
});

function initParams(){
	newsId = getReqParam("newsId");
	currProId = getReqParam("projectId");
}

function initListeners(){
	$("#subBtn").click(submitInfo);
	$("#backBtn").click(toNewsListPage);
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
				$("#projectInp").val(msg.data[0].FNAME);
			}else{
				alert("aa"+msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadProjectSelector(){
	$("#projectInp").html('<option value="-1">无</option');
	if(newsId) $("#projectInp").attr("disabled","true");

	if(projectList && projectList.length > 0){
		var tempHtml = "";
		var selectedStr = "";
		$.each(projectList, function(ind, val){
			selectedStr = "";
			if((newsId && newsInfo.FPROJECTID == val.projectId) 
				|| val.projectId == currProId) 
				selectedStr = "selected";
			tempHtml += '<option value="'+val.projectId+'" '+selectedStr+'>'+val.projectName+'</option>';
		});
		$("#projectInp").html(tempHtml);
	}
}

function getNewsInfo(){

	var ctx="<?php echo site_url();?>";

	$.ajax({
		type:'post',//可选get
		url:ctx+'news/getDynamicNewsDetail',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'newsId':newsId
		},
		success:function(msg){
			if(msg.success){
				newsInfo = msg.data[0];
			}else{
				alert(msg.error);
			}
			//loadProjectSelector();
			loadNewsInfo();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function loadNewsInfo(){
	if(newsInfo){
		$("#titleInp").val(newsInfo.FTITLE);
		$("#projectInp").val(newsInfo.FPROJECTNAME);
		$("#permissionSel").val( newsInfo.FSTATE).prop('selected',true);
		ueObj.execCommand('insertHtml', newsInfo.FCONTENT);
	}
}

function submitInfo(){
	var _cont = ueObj.getContent();
	var _title = $("#titleInp").val();
	var _permission = $("#permissionSel").val();

	if(!_cont || _cont.length <= 0){
		alert("内容不能为空！");
		return false;
	}else if(!_title || _title.length <= 0){
		alert("标题不能为空！");
		return false;
	}

	var _url = "";
	var _param = {};
	if(newsId){
		// 修改
		_url = "update";
		var _proid = getReqParam('projectId');
		_param = {
			'FID':newsId,
			'FTITLE':_title,
			// 'author':"",
			// 'projectId':_proid,
			'FCONTENT':_cont,
			'FPROJECTID':_proid,
			'FSTATE': _permission
		};
		updateNews(_param);
	}else{
		// 新增
		var _proid =  getReqParam('projectId');
		if(_proid == "-1"){
			alert("请选择项目!");
			return false;
		}

		_param = {
			'FTITLE':_title,
			// 'author':"",
			'FPROJECTID':_proid,
			'FCONTENT':_cont,
			'FCREATORID': uid,
			'FSTATE': _permission
		};
		addNews(_param);
	}

}

function updateNews(_param)
{
	var ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'news/updateNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_param,
		success:function(msg){
			if(msg.success){
				var _tip = "新增成功！";
				if(newsId){
					_tip = "更新成功！";
				}
				alert(_tip);
			}else{
				alert(msg.error);
			}
			toNewsListPage();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function addNews(_param)
{
	var ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'news/addNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_param,
		success:function(msg){
			if(msg.success){
				var _tip = "新增成功！";
				if(newsId){
					_tip = "更新成功！";
				}
				alert(_tip);
			}else{
				alert(msg.error);
			}
			toNewsListPage();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function toNewsListPage(){
	// location.hash = "projectNewsInfo";
	location.href = "/back/index/projectManage?projectId="+currProId+"#projectNewsInfo";
}
</script>
</html>