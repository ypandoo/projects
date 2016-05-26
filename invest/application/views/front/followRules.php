<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>跟投制度</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/followRules.css')?>">
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/followRules.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ueditor/ueditor.config.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ueditor/ueditor.all.min.js')?>"></script>

</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 跟投制度</div>
	<div id="contentFrame">
		<div id="scheme_info" class="info_STY" style="width:98%; margin-left:1%">
			<div id="titleTab" style="">
						<div anchor="scheme" class="tabSTY focusOn">跟投制度</div>
			</div>

				<div>
		<table id="editTable" border="1" style="width:90%">

							<tr>
								<td class="richTd">
									<textarea style="display:none;"></textarea>
									<script id="editor" type="text/plain" style="width:100%;height:350px;"></script>
								</td>
							</tr>

		</table>
	</div>
		</div>

	</div>




	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">

var ueObj = null;
var newsInfo = null;
var FID;
var ctx="http://192.168.5.15/";
window.UEDITOR_HOME_URL = ctx+"application/views/plugins/ueditor/";
window.UEDITOR_CONFIG.toolbars = [[
]];
ueObj = UE.getEditor('editor');
$(function(){
	initListeners();
	setTimeout(getNewsInfo, 500);
});

function initParams(){
}

function initListeners(){

}

function getNewsInfo(){

	var ctx="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'SubscriptionSystem/getSubscriptionSystemInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		success:function(msg){
			if(msg.success){
				newsInfo = msg.data[0];
				FID = newsInfo.FID;
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
		//ueObj.execCommand('insertHtml', newsInfo.FCONTENT);
		ueObj.setContent(newsInfo.FCONTENT, false);
	}
}
</script>
</body>
</html>