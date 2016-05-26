
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="copyright" content="" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
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
	height: 100px;
	border-bottom: 1px dotted #FF9600;
}

.row2{
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
	font-size:16px;
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

#header{}

#contentLayer .searSTY{float: left;margin-right: 10%;}
#contentLayer .floatR{float: right;margin-right: 0;}

#contentLayer #naviTitle{height: 25px;line-height: 25px;}
#contentLayer #searchLayer{overflow: hidden;margin: 5px 0px;}
#contentLayer #searchLayer #searchText{width: 150px;}
#contentLayer #searchLayer .dateSTY{height: 25px}
#contentLayer #searchLayer .btnSTY{min-width: 60px;height:30px;line-height:30px;text-align: center;
	border: 1px solid #A0A0A0;background: #FFF;	cursor: pointer;border-radius: 3px;}
#contentLayer #searchLayer .btnSTY:hover{color: #f9371d;border-color: #f9371d;}

#contentLayer #contentList{width: 100%;padding: 10px;background: #FFF;overflow:hidden;}
#contentLayer #contentList .listSTY{    height: 160px;
    width: 100%;
    border-bottom: 1px dotted #FFC321;
    overflow: hidden;
    margin-bottom: 15px;}
#contentLayer #contentList .listSTY .imgLayer{float: left;width: 210px;height: 130px;margin: 10px 15px;}
#contentLayer #contentList .listSTY .textLayer{float: right;margin-left: 10px;width: 830px;}
#contentLayer #contentList .listSTY .textLayer .proTitle{font-size: 14px;font-weight: bold;}
#contentLayer #contentList .listSTY .textLayer .proInfo{height: 100px;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable{font-size: 14px;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable td{padding: 0px 5px;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable td span{color: #FF2608;font-weight: bold;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable .titleTd{text-align: right;width: 115px;color: black;font-weight: 100;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable .boldSTY{font-weight: bold;}
#contentLayer #contentList .listSTY .textLayer .proInfoTable .pointSTY{color: #FF2608;}
#contentLayer #contentList .listSTY .textLayer .buttonLayer{overflow: hidden;}
#contentLayer #contentList .listSTY .textLayer .buttonLayer div{float:right;margin:0px 10px;
	cursor: pointer;}
#contentLayer #contentList .listSTY .textLayer .buttonLayer div a{display: block;text-align: center;
	border: 1px solid #929090;border-radius: 5px;padding: 5px 10px;background: #d34134;color:#FFF;}
#contentLayer #contentList .listSTY .textLayer .buttonLayer div a:hover{background: #FFF;color: #d34134;border: 1px solid #e8e8e8;}


</style>
</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div style = "margin-top:-67px">
	<img src="<?php echo site_url() ?>application/views/front/img/title.jpg" width="100%">
	
	<img src="<?php echo site_url() ?>application/views/front/img/subtitle1.png" width="100%" style="margin-top:20px">
	<div class="content">
			<div class="float divide25 number_box">
				<div class="float number"><img src="<?php echo site_url() ?>application/views/front/img/gtzs.png" ></div>
				<div>项目跟投总数: <span id="projectCount" style="color:red; font-weigh:600"></span></div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"><img src="<?php echo site_url() ?>application/views/front/img/gtrc.png"></div>
				<div>认购人次: <span id="peopleCount" style="color:red; font-weigh:600"></span></div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"></span><img src="<?php echo site_url() ?>application/views/front/img/rgze.png"></div>
				<div>认购总额(含杠杆): <span id="subAmount" style="color:red; font-weigh:600"></div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"><img src="<?php echo site_url() ?>application/views/front/img/fhze.png"></div>
				<div>分红总额: <span id="bonusAmount" style="color:red; font-weigh:600"></span></div>
			</div>
	</div>



	<img src="<?php echo site_url() ?>application/views/front/img/subtitle3.png" width="100%" style="margin-top:20px">
	<div class="content" style="clear:both; overflow:hidden">
		<table width="100%" class="pay_bill " id="news">
	        <tbody>

	        </tbody>
		</table>
	</div>
	<div class="content moreinfo" style="clear:both; overflow:hidden">
		<div><a href="<?php echo site_url() ?>/home/index/newsList"  style="color:white">查看更多</a></div>
	</div>



	<img src="<?php echo site_url() ?>application/views/front/img/subtitle2.png" width="100%" style="margin-top:20px">
	<div id="contentLayer">
	<div id="contentList">
	</div></div>

	<div class="content moreinfo" style="clear:both; overflow:hidden">
		<div><a href="<?php echo site_url() ?>/home/index/projectList" style="color:white">查看更多</a></div>
	</div>


	<div style="margin-bottom:80px"></div>

	<div class=" moreinfo" style="clear:both; overflow:hidden;text-algin:center; color:#2e2e2e">
		中梁地产集团
	</div>

</div>

<script type="text/javascript">
	// 导航下标
var naviInd = "0";
// 新闻列表内容
var newsList = [];
// 项目列表内容
var projectList = [];
// 系统概览内容
var systemInfo = {};

var uid="<?php echo $uid; ?>";

$(function(){
	initParams();
	//initListeners();
	initPages();
});

function initParams(){

	systemInfo = {
		proCount: "0",
		peopleCount: "0",
		subAmount: "0",
		bonusAmount: "0"
	};
}

function initListeners(){
	initHeaderListeners();
}

function initPages(){
	getProjectData();
	getNewsData();
	getSysInfo();
}
function getNewsData(){
	var ctx="<?php echo site_url();?>";

	//var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'News/getAllNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		//begin=0&count=2&uid=test&projectId=123
		data:{//begin: 0,
			//count:2,
		    uid: uid,
		    /*pojectId: '123'*/},
		success:function(msg){
			if(msg.success){
				newsList=msg.data;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getProjectData(){
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
			subscribeStartDate: "2000-01-01",
			subscribeEndDate:"2100-01-01",
			queryType: 1,	
		},
		success:function(msg){
			if(msg.success){
				projectList=msg.data;
				loadData(projectList);
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getSysInfo(){
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'project/getStatisticsInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				if(msg.data ){
					systemInfo = msg.data;
					loadSysInfo();
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
function loadSysInfo(){
	/*
	FPROJECTCOUNT: "0"
FSUBSCRIBECONCOUNT: "9"
FTOTALAMOUNT: "2000471"
FTOTALBONUSAMOUNT: "15"
	*/
	$("#projectCount").html(systemInfo.FPROJECTCOUNT||0);
	$("#peopleCount").html(systemInfo.FSUBSCRIBECONCOUNT||0);
	$("#subAmount").html((systemInfo.FTOTALAMOUNT||0)+'万元');
	$("#bonusAmount").html((systemInfo.FTOTALBONUSAMOUNT||0)+'万元');
}
function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
function loadNewsData(){
	var tempHtml = "";
	// newsList = [{}];  // 测试数据
    /*
    	        <tr class="row">
	            <td class="">
	            	<h2><a href="#" style="color:red">2015/12/23</a></h2>
	            	<br>
	                <h2><a href="#">养生餐</a></h2>
	                <br>
	                <h4>
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                </h4>
	                
	            </td>
	        </tr>
    */
    var ctx = "<?php echo site_url();?>";
    var newslink = ctx+'home/index/newsDetail?newsId=';
	//{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}
	var listNum = 0;
	$.each(newsList, function(ind, val){
		if (listNum >= 3) 
		{
			return false;
		};
	    tempHtml += '<tr class="row"><td><h4><a style="color:red">'+val.FRELEASEDATE+'</a></h4><br>';
	    tempHtml += '<h4 style="font-weight:600"><a href="'+newslink+val.FID+'">'+val.FTITLE+'</a></h2></td></tr>';
	    listNum++;
		//tempHtml += '<h4 style=""><a href="'+newslink+val.FID+'">'+val.FCONTENT +'</a></h4><br></td></tr>';
	})
	$("#news tbody").html(tempHtml);
}


function loadData(dataList){
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
ImageName: "default.jpg"
总部最大可跟投总额（含杠杆）		总部实际已跟投总额（含杠杆）
区域最大可跟投总额（含杠杆）		区域实际已跟投总额（含杠杆）
	*/
	var tempHtml = "";
	var tempObj = null;
	var tempImg = "<?php echo site_url() ?>images/default.jpg";

	for(var i=0; i<dataList.length; i++){
		if(i==5)
			break;
		tempObj = dataList[i];
		if (tempObj.FSTATUS == '0') {continue;};
		if(tempObj.ImageName){
			tempImg = "<?php echo site_url() ?>images/"+tempObj.ImageName;
		}
		
		/*测试数据 begin*/
		/*if(tempObj.FNAME.indexOf("合肥")){
			amm1 = 6650;
			amm2 = 55;
			amm3 = 3658;
			amm4 = 45;
		}else if(tempObj.FNAME.indexOf("苏州")){
			amm1 = 7436;
			amm2 = 55;
			amm3 = 4089;
			amm4 = 45;
		}
		/* end */
		tempHtml = 
		'<div class="listSTY">'+
			'<div class="imgLayer"><a href="<?php echo site_url()?>home/index/projectDetail?projectId='+tempObj.FPROJECTID+'"><img src="'+tempImg+'" width="100%" height="100%"></a></div>'+
			'<div class="textLayer">'+
				'<div class="proTitle"><a href="<?php echo site_url()?>home/index/projectDetail?projectId='+tempObj.FPROJECTID+'">项目名称：'+tempObj.FPROJECTNAME+'</a></div>'+
				'<div class="proInfo">'+
					'<table class="proInfoTable" height="100%" width="100%" border="0"><tr>'+
						'<td class="titleTd">项目认购开始时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.FSUBSCRIBESTARTDATE)).format('yyyy-MM-dd')+'</span> 至 <span>'
						+(new Date(tempObj.FSUBSCRIBEENDDATE)).format('yyyy-MM-dd')+'</span></td>'+
						'<td class="titleTd">资金募集时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.FPAYSTARTDATE)).format('yyyy-MM-dd')+'</span> 至 <span>'
						+(new Date(tempObj.FPAYENDDATE)).format('yyyy-MM-dd')+'</span></td>'+
						/*'<td class="titleTd">跟投总额(含杠杆):</td>'+
						'<td>'+amm1+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">总部最大可跟投总额（含杠杆）:</td>'+
						'<td class=""><span>'+(tempObj.FHDAMOUNT||0)+'</span> 万元</td>'+
						'<td class="titleTd">总部实际已跟投总额（含杠杆）</td>'+
						'<td class=""><span>'+(tempObj.FHDSUAMOUNT||0)+'</span> 万元</td>'+
						/*'<td class="titleTd">已认购总额(含杠杆):</td>'+
						'<td>'+0+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">区域最大可跟投总额（含杠杆）:</td>'+/*强投包比例(含杠杆)*/
						'<td id="groupForceAmount"><span>'+(tempObj.FREGIONAMOUNT||0)+'</span> 万元</td>'+
						'<td class="titleTd">区域实际已跟投总额（含杠杆）:</td>'+/*强投包总额*/
						'<td id="compForceAmount"><span>'+(tempObj.FREGIONSUAMOUNT||0)+'</span> 万元</td>'+
						/*'<td class="titleTd">选投包比例(无杠杆):</td>'+
						'<td id="compChoiceAmount">'+amm4+' %</td>'+*/
					'</tr></table>'+
				'</div>'+
				'<div class="buttonLayer">';
					//+'<div class="forumBtn"><a target="_blank" href="http://ekp.cifi.com.cn/module<?php echo site_url()?>?nav=/km/forum/tree.jsp&main=/km/forum/km_forum_cate/kmForumCategory.do?method=main">答疑讨论区</a></div>';
				if(tempObj.FISSU == 2 && new Date(tempObj.FSUBSCRIBESTARTDATE)<=new Date() && new Date(tempObj.FSUBSCRIBEENDDATE)>=new Date())
				{
					var ctx = "<?php echo site_url();?>";
   					var newslink = ctx+'home/index/subscribeApply?projectId=';		
					tempHtml+='<div class="subscribeBtn"><a href="'+newslink+tempObj.FPROJECTID+'">我要认购</a></div>';
				}
				tempHtml+='</div>'+ 
			'</div>'+
		'</div>';
		$("#contentList").append(tempHtml);
	}
	//lengVal = dataList.length;
}
</script>
</body>

