<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>项目动态新闻</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/newsDetail.css')?>">


<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/newsDetail.js')?>"></script>

</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle">
		<a href="<?php echo site_url()?>">首页</a> 
		> <a id="returnDynList" href="">动态新闻列表</a> 
		> 项目动态新闻
	</div>
	<div id="newsTitle"></div>
	<div id="newsProperty"></div>
	<div id="liner"></div>
	<div id="newscontent" style="margin-top: 20px">
<!-- <pre>合肥高新项目的跟投申报还在开放中，提醒有意向的同事积极跟投。
公示《跟投方案》中未考虑引入外部资金方对盈利的影响，为了提高自有资金收益率，合肥公司和财务相关部门还在积极落实合作内容，具体内容将在项目过程信息中予以公示。
若选投包额度有剩余，可向强投包人员开放。
1、联 系 人：合肥事业部人事行政部 陶忠运 taozy@cifi.com.cn；严爱华 yanah@cifi.com.cn （同时发送）
2、申报方式：邮件方式
3、申报时间：2014.8.6～2014.8.15 （在有限合同注册完成前可适量延长申报时间至8.20）
5、申报格式：举例
跟投申报人	所属公司		所属部门		跟投属性	出资额		杠杆额度	跟投总额
张三		合肥事业部		财务管理部		强投包		10万		40万		50万
李四		集团总部		投资发展部		选投包		20万		0		20万
6、资金募集：待有限合作企业的设立后，另行通知资金募集的时间以及其他相关内容。
</pre> -->
	</div>
</div>
<div id="footer">中梁地产集团</div>

<script type="text/javascript">
	// 导航下标
var naviInd = "1";
var newsInfo = null;
var newsId = null;
var projectId = null;

$(function(){
	initNewsParams();
	//initNewsListeners();
	initNewsPages();
});

function initNewsParams (argument) {
	newsId = getReqParam("newsId");
	//projectId = getReqParam("projectId");
}
function initNewsListeners (argument) {
	initHeaderListeners();
}

function initNewsPages (argument) {
	getNewsDetail();
}

function getNewsDetail(){
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
			loadNewsInfo();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert(errorThrown); 
		}
	});
}

function loadNewsInfo () {
	if(newsInfo){
		/*
		FCONTENT: "合肥高新项目对账公示-1 - 内容"
FCREATORID: "123"
FID: "124"
FPROJECTID: "1"
FRELEASEDATE: "2016-01-17 08:58:47"
FTITLE: "合肥高新"
__proto__: Object
		*/
		$("#newsTitle").text(newsInfo.FTITLE);
		$("#newsProperty").html('<span>发布人：'+newsInfo.FUSERNAME+'</span><span>'+(new Date(newsInfo.FRELEASEDATE)).format('yyyy-MM-dd')+'</span><span>'+(newsInfo.FPROJECTID||"")+'</span>');
		$("#newscontent").html(newsInfo.FCONTENT);

		if(newsInfo.projectId){
			projectId = newsInfo.projectId;
		}
	}
	$("#returnDynList").attr("href","/home/index/newsList/?tabInd=news&proId="+projectId)
}
</script>

</body>
</html>