<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>已完成认购列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/completed.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>
</head>

<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 已完成认购</div>
	<div id="searchLayer">
		<!--div class="searSTY floatR">
			<input id="searchText" placeholder="请输入项目名" value="" />&nbsp;
			<button id="searchBtn">搜索</button>
		</div-->
	</div>
	<div id="listLayer">
		<table width="100%" border="1">
			<thead>
				<tr>
					<td rowspan="2" width="50" height="30">序号</td>
					<td rowspan="2" width="150">跟投项目</td>
					<td rowspan="2" width="80">认购时间</td>
					<td colspan="2">认购额度</td>
					<td colspan="2" class="displayNone">调整额度</td>
					<!--td colspan="2">平衡额度</td-->
					<td rowspan="2" width="100">缴款确认金额<br>(万元)</td>
					<td rowspan="2" width="100">已分红总额<br>(万元)</td>
					<td rowspan="2" width="150">分红帐号</td>
					<td rowspan="2" width="100px">操作</td>
				</tr>
				<tr>
					<td width="110">出资金额(万元)</td>
					<td width="110">杠杆金额(万元)</td>
					<td width="110" class="displayNone">出资金额(万元)</td>
					<td width="110" class="displayNone">杠杆金额(万元)</td>
					<td width="110" class="displayNone">出资金额(万元)</td>
					<td width="110" class="displayNone">杠杆金额(万元)</td>
				</tr>
			</thead>
		<tbody id="compTbody">
			<!-- <tr><td width="50" height="35">1</td>
			<td width="170">合肥高新项目</td>
			<td width="120">123,000.00</td>
			<td width="120">123,000.00</td>
			<td width="120">123,000.00</td>
			<td width="120">123,000.00</td>
			<td width="120">123,000.00</td>
			<td>
				<a id="change" href="javascript:void(0)">更换收款账号</a>&nbsp;&nbsp;
				<a id="view" href="javascript:void(0)">查看</a>
			</td></tr> -->
		</tbody></table>
	</div>

	<!-- 弹出层 -->
	<div id="dialogBg" style="display:none;"></div>
	<div id="dialogLayer" style="display:none;">
		<div class="title">
			<span class="titleSTY">收款银行账号列表</span>
			<!--span class="closeSTY"><img src="./images/close.png" width="100%" height="100%"></span-->
		</div>
		<div class="list">
			<table width="100%" border="1"><thead><tr>
				<td width="40" height="30px;"></td>
				<td width="150">银行卡号</td>
				<td width="80">开户名</td>
				<td>开户行</td>
			</tr></thead>
			<tbody id="bankTbody">
				<!-- <tr><td height="25">
					<input type="checkbox" name="bankCk" />
				</td><td>
					XXXX XXXX XXXX XXX
				</td><td>
					张三
				</td><td>
					中国银行中国银行中国银行中国银行
				</td></tr> -->
			</tbody></table>
		</div>
		<div class="bottom">
			<div class="cancelBtn"></div>
			<div class="saveBtn"></div>
		</div>
	</div>
</div>
<div id="footer">中梁地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "2";
var dataList = [];
var bankList = [];
var tempObj = null;
var uid ="<?php echo $uid ?>";

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	dataList = [];
}

function initListeners(){
	initHeaderListeners();

	// 呼出弹出层
	$("#compTbody").on("click",".change", function(){
		tempObj = dataList[$(this).attr("ind")];
		getBankData();
		callDialog();
	});
	// 隐藏弹出层
	$("#dialogLayer .closeSTY").click(function(){
		hideDialog();
	});
	$("#dialogLayer .cancelBtn").click(function(){
		hideDialog();
	});
	$("#dialogLayer .saveBtn").click(function(){
		var _bankId = $(":checkbox[name='bankCk'][checked='checked']").attr("val")||"";
		updateBank(_bankId);
	});
	$("#bankTbody").on("click",":checkbox[name='bankCk']", function(){
		if($(this).attr("checked")){
			$(":checkbox[name='bankCk']").removeAttr("checked");
			$(this).attr("checked","checked");
		}
	})
}

function initPages(){
	getData();
}

function getData(){
	var ctx = "<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Subscription/getHasSubscribe',
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{uid:uid},
		success:function(msg){
			if(msg.success){
				dataList = msg.data;
				loadData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loadData(){
	$("#compTbody").empty();
	if(dataList && dataList.length > 0){
		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td height="35">'+(ind+1)+'</td>'+
				'<td><a href="projectDetail.jsp?proId='+val.FID+'">'+(val.FNAME||"")+'</a></td>'+
				//'<td>'+ (val.isRemissionSubscribe == true ? "是" : "否") +'</td>'+
				'<td>'+(val.FCREATETIME)+'</td>'+
				'<td>'+(val.FAMOUNT||0)+'</td>'+
				'<td>'+(val.FLEVERAMOUNT||0)+'</td>'+
				//'<td class="displayNone">'+(val.adjustamt)+'</td>'+
				//'<td class="displayNone">'+(val.adjustLeverageAmt)+'</td>'+
				//'<td>'+(val.FCONFIRMAMOUNT||0)+'</td>'+
				// '<td width="120">'+formatMillions(val.bonusAmount)+'</td>'+
				//'<td>'+(val.FLEVERCONFIRMAMOUNT||0)+'</td>'+
				'<td>'+(val.TOTALFPAYAMOUNT || 0)+'</td>'+
				'<td>'+(val.TOTALFBONUSAMOUNT || 0)+'</td>'+
				'<td>'+val.FBANKNO+'</td>'+
				'<td>'+
					'<a class="change" href="javascript:void(0)" ind="'+ind+'">更换收款账号</a>&nbsp;&nbsp;'+
					// '<a class="view" href="javascript:void(0)">查看</a>'+
			'</td></tr>';
		});
		$("#compTbody").html(tempHtml);
	}
}

function getBankData(){
	bankList = [];
	var ctx = "<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'bankInfo/getPersonBankInfo',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{uid: uid},
		success:function(msg){
			if(msg.success){
				bankList = msg.data;
				loadBankData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadBankData(){
	$("#bankTbody").empty();
	if(bankList && bankList.length > 0){
		var tempHtml = "";
		var tempStr = "";
		/*
						'<td width="315">'+val.FBANKNO+'</td>'+
				// '<td width="225">'+val.uName+'</td>'+
				'<td width="225">'+val.FBANKATTRIBUTE+'</td>'+
				'<td width="225">'+val.FNAME+'</td>'+
		*/
		$.each(bankList, function(ind, val){
			tempStr = tempObj.FID==val.FID?'checked="checked"':"";
			tempHtml += '<tr><td height="25"><input type="checkbox" name="bankCk" '+tempStr+' val="'+val.FID+'" /></td>'+
				'<td>'+val.FBANKNO+'</td>'+
				'<td>'+val.FBANKATTRIBUTE+'</td>'+
				'<td>'+val.FNAME+'</td></tr>';
		});
		$("#bankTbody").html(tempHtml);
	}
}

function updateBank(_bankId){
	var _obj = '{"csrId":"'+tempObj.csrId+'","bankNo":"'+_bankId+'"}'
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/updateBank.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				alert("修改成功!");
				getData();
				hideDialog();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function callDialog(){
	$("#dialogBg").show();
	$("#dialogLayer").show();
}

function hideDialog(){
	$("#dialogBg").hide();
	$("#dialogLayer").hide();

}

function formatDate(_str){
	if(_str){
		return _str.substring(0,4)+"-"+_str.substring(4,6)+"-"+_str.substring(6,8);
	}else{
		return "";
	}
}
</script>
</body>

</html>