
<html>
<head>
<title>数据维护系统 - 跟投规则编辑</title>
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
	<td colspan="2"><a id="backBtn" href="javascript:void(0)"><- 返回后台管理</a></td>
</tr>

<tr>
	<td class="richTd">
		<textarea style="display:none;"></textarea>
		<script id="editor" type="text/plain" style="width:100%;height:350px;"></script>
	</td>
</tr>

<tr>
	<td colspan="2" align="center"><button id="subBtn">提交</button></td>
</tr></table>
</body>

<script type="text/javascript">
window.UEDITOR_HOME_URL = "/investment/plugins/ueditor/";
window.UEDITOR_CONFIG.toolbars = [[
    'undo', 'redo', '|',
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 
    'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    'directionalityltr', 'directionalityrtl', 'indent', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 
    'touppercase', 'tolowercase',
]];

var ueObj = null;
var newsInfo = null;

$(function(){
	ueObj = UE.getEditor('editor');
	initParams();
	initListeners();
});

function initParams(){
}

function initListeners(){
	$("#subBtn").click(submitInfo);
	$("#backBtn").click(toNewsListPage);
}

function getNewsInfo(){

	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'/',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		success:function(msg){
			if(msg.success){
				newsInfo = msg.data[0];
				loadNewsInfo();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function loadNewsInfo(){
	if(newsInfo){
		ueObj.execCommand('insertHtml', newsInfo.FCONTENT);
	}
}

function submitInfo(){
	var _cont = ueObj.getContent();
	var _param = {};
	_param = {
			'FCONTENT':_cont,
		};
	updateNews(_param);
}

function updateNews(_param)
{
	var ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'/',
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
	var ctx ="<?php echo site_url() ?>" 
	location.href = ctx+"back";
}
</script>
</html>