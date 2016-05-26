<!DOCTYPE html>
<html>
<head>
<title>动态新闻列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/newsList.css')?>">
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>

</head>

<style type="text/css">
.float{float: left;}
.divide25{width: 25%}
.number{width:40px; margin-top:5px;}
.number_box{height:50px; line-height: 50px; font-size: 14px; font-family: 'Microsoft YaHei'; color: #2e2e2e}
.content{    width: 1024px;
    margin-top: 20px;
    left: 50%;
    position: relative;
    margin-left: -512px;}
.row{
	height: 200px;
	border-bottom: 1px dotted #FF9600;
}

.left_td
{
	width: 224px;
	text-align: left;
}

.right_td
{
	width: 800px;
	text-align: left;
}

h2
{
	font-size:20px;
	font-weight: 600;
}

.moreinfo
{
	background-color: #E5BE8F;
	color: #FFF;
	height: 40px;
	line-height: 40px;
	text-align: center;
}
</style>


<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url();?>">首页</a> > 动态新闻列表</div>
	<!--div id="searchLayer">
		<div class="searSTY floatR">
			<input id="searchText" placeholder="请输入标题或项目进行搜索" type="search" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div>
	</div>
	<div id="listLayer">
		<table width="100%" border="1"><thead><tr>
			<td width="100" height="30">序号</td>
			<td width="300">标题</td>
			<td width="200">创建时间</td>
			<td width="300">所属项目</td>
			<td>作者</td>
		</tr></thead>
		<tbody id="newsTbody">
			<!-- <tr><td height="35">1</td>
			<td><a href="./newsDetail.html">合肥高新项目对账公示</a></td>
			<td>2014-07-19</td>
			<td>合肥高新项目</td>
			<td>张三</td></tr>
		</tbody></table>
	</div> -->

	<div class="content" style="clear:both; overflow:hidden">
		<table width="100%" class="pay_bill " id="news">
	        <tbody>

	        </tbody>
		</table>
	</div>

	<!--div class="content moreinfo" style="clear:both; overflow:hidden">
		<div onclick="see_more()">查看更多</div>
	</div-->
</div>
<div id="footer">中梁地产集团</div>

<script type="text/javascript">
	// 导航下标
var naviInd = "1";
var dataList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams (argument) {
	// body...
}

function initListeners (argument) {
	initHeaderListeners();

	$("#searchBtn").click(getNewsList);
}

function initPages (argument) {
	getNewsList();
}

function getNewsList(){
	var _searText = $("#searchText").val();
	/*$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByUser.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:'{"userid":"","pageSize":"'+999+'","projectName":"'+_searText+'"}',
		success:function(msg){
			if(msg.success){
				dataList=msg.dataDto;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})*/
	var ctx="<?php echo site_url();?>";
	//var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'News/getAllNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		//begin=0&count=2&uid=test&projectId=123
		data:{begin: 0,
			count:2,
		    uid: '1',
		    pojectId: '27'},
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
	})
}

function loadNewsData(){
	$("#news tbody").empty();
	if(newsList && newsList.length > 0){
		var tempHtml = "";
		//{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}
		$.each(newsList, function(ind, val){
		    tempHtml += '<tr class="row"><td><h4><a style="color:red">'+val.FRELEASEDATE+'</a></h4><br>';
		    tempHtml += '<h4 style="font-weight:600"><a href="/home/index/newsDetail?newsId='+val.FID+'">'+val.FTITLE+'</a></h2>';
			tempHtml += '<h4><a href="/home/index/newsDetail?newsId='+val.FID+'">'+val.FCONTENT +'</a></h4><br></td></tr>';
		})
		$("#news tbody").html(tempHtml);
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