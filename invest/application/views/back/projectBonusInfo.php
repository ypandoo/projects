<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 分红明细列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/plugins/pagination.css')?>">
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.pagination.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ajaxfileupload.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<!--link rel="stylesheet" type="text/css" href="../plugins/pagination.css" />
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../plugins/jquery.pagination.js"></script>
<script type="text/javascript" src="../plugins/ajaxfileupload.js"></script-->

<style type="text/css">
body{font-size: 12px;}
#rightLayer #searchLayer{text-align: right;margin:0px auto 10px;position: relative;}
#rightLayer #searchLayer .btnSTY{float: left;margin: 7px 5px 0px;}
#rightLayer #searchLayer input{width: 200px;height: 25px;padding:0px 5px;}
#rightLayer #searchLayer .dateSTY{width: 100px;}
#rightLayer #bonusTable{border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;}
#rightLayer #bonusTable thead{background: url(images/thead_bg.png);}
#rightLayer #bonusTable td{text-align: center;border: 1px solid #e8e8e8;}
#rightLayer #bonusTable input{width: 60px;height: 25px;}


#dialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#dialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#dialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 1000px;height: 350px;margin: 100px auto;}
#dialogLayer .dialogSTY .tipTitle{padding: 14px 15px;float: left;}
#dialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#dialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#dialogLayer .dialogSTY .contentDiv{width: 96%;height: 265px;margin: 3px auto;border: 0px solid #e8e8e8;clear: both;}
#dialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#dialogLayer .dialogSTY .contentDiv table thead{background:url(images/thead_bg.png);;}
#dialogLayer .dialogSTY .contentDiv table td{padding: 1px 5px;text-align: center;border: 1px solid #e8e8e8;}
#dialogLayer .dialogSTY .contentDiv table input{width: 50px;text-align: center;padding: 0px 2px;height: 20px;line-height: 20px;}
#dialogLayer #bonusPagination{clear: both;margin-left: 20px;}
#dialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#dialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#dialogLayer .searDiv button{width: 50px;height: 25px;margin: 0px 5px;}
</style>
<script type="text/javascript">
var subscribeList = [];
var bonusList = [];
$(function(){
	getBonusList();
	initBonusListeners();
});

function initBonusListeners(){
	$("#sDateInp").datetimepicker({format:'Y-m-d',timepicker:false});
	$("#eDateInp").datetimepicker({format:'Y-m-d',timepicker:false});

	$("#searTextBtn").click(getBonusList);
	$("#clearTextBtn").click(function(){
		$("#sDateInp").val("");
		$("#eDateInp").val("");
		$("#searTextInp").val("");
		getBonusList();
	});
	$("#subscribeTbody .addBonusBtn").live("click",addBonusFunc);
	$("#bonusTbody .delBtn").live("click", delBonusFunc);

	$("#callBonusDialog").click(function(){
		getSubscribeList();
		callDialog();
	});
	$("#dialogLayer #okBonusBtn").click(function(){
		getBonusList();
		hideDialog();
	});
	// 导出分红模板
	$("#rightLayer #exportSubBtn").click(function(){
		var ctx = "<?php echo site_url();?>";
		$.ajax({
			type: "post",

			url: ctx+'BonusRecord/outputXls', //用于文件上传的服务器端请求地址
			dataType: 'JSON', //返回值类型 一般设置为json
			data:{
				projectId:getReqParam("projectId"),
					startDate:'2013-09-01 09:50:00',
					endDate:'2016-09-01 09:50:00',
					uname:'',
					userId:1,
			},
			success: function (msg){  //服务器成功响应处理函数			
				if(msg.success == true){
					//alert("导入成功!");
					//getPayInList();
					//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
					location.href=ctx+'fileFolder/'+msg.data;
				}else{
					alert("1:"+msg.error);
				}
			},
			error: function (data, status, e){//服务器响应失败处理函数		
				alert("2:"+e);
			}
		})
	});


	// 自动生成分红
	$("#rightLayer #autobonus").click(function(){
		//	<input  id="noInp" style="width:70px" placeholder="分红批次" />
	//<input  id="noAmount"  style="width:70px" placeholder="分红总额" />
	//<!-- <button id="callBonusDialog" class="btnSTY">新增分红</button> -->
	//<button id="autobonus" class="btnSTY">生成分红明细</button>

	var _noInp = $("#noInp").val();
	var _noAmount = $("#noAmount").val();


	if (_noInp != undefined || _noAmount != undefined) {alert('请输入有效的分红批次值或总额！'); return;};
	var _obj = {
		'projectId': getReqParam("projectId"),
		'time': _noInp,
		'totalBonus': _noAmount
	};

	var ctx = "<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url: ctx+'BonusRecord/updateBonusRecordWithTotalBonues', //用于文件上传的服务器端请求地址
		dataType: 'JSON', //返回值类型 一般设置为json
		data:_obj,
		success: function (msg){  //服务器成功响应处理函数			
			if(msg){
				//bonusList = msg.data;
				//loadBonusList();
				alert("生成成功");
				window.location.reload();
			}else{
				alert("1:"+msg.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert("2:"+e);
		}
	})

	});



	// 导入分红
	$("#rightLayer #importBtn").click(function(){
		$("#file").click();
	});
	// 导出分红
	$("#rightLayer #exportBonusBtn").click(function(){
		//location.href = "../BonusDetailController/callBonusExport.action?projectId="+projectId+"&bonusIds=";
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();
	var _obj = {projectId: getReqParam("projectId"),
				startDate:_sDate,
				endDate:_eDate,
				uname:_searText,
				startPage:0,
				endPage:999
	};
	var ctx = "<?php echo site_url();?>";
		$.ajax({
			type:'post',//可选get
			url: ctx+'BonusRecord/exportBonusRecordXls', //用于文件上传的服务器端请求地址
			dataType: 'JSON', //返回值类型 一般设置为json
			data:_obj,
			success: function (msg){  //服务器成功响应处理函数			
				if(msg.success == true){
					//alert("导入成功!");
					//getPayInList();
					//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
					location.href=ctx+'fileFolder/'+msg.data;
				}else{
					alert("1:"+msg.error);
				}
			},
			error: function (data, status, e){//服务器响应失败处理函数		
				alert("2:"+e);
			}
		})

	});
	$("#file").live("change", importBonusFunc);
}

function getBonusList(){
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();
	var ctx="<?php echo site_url();?>";
	var _obj = {projectId: getReqParam("projectId"),
		// '"projectName":"'+_searText+'",'+
		startDate:_sDate,
		endDate:_eDate,
		// '"piId":"",'+
		// '"piTimes":0,'+
		// '"subscribeAmt":0,'+
		// '"piDate":"",'+
		// '"piAmt":0,'+
		// '"numberCode":"",'+
		uname:_searText,
		// '"userId":""'+
		startPage:0,
		endPage:999
		};
	$.ajax({
		type:'post',//可选get
		url:ctx+'BonusRecord/getBonusRecordListByName',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				bonusList = msg.data;
				loadBonusList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadBonusList(){
	$("#bonusTbody").empty();
	/*
		<td height="34" width="40">序号</td>
	<td width="100">跟投人</td>
	<td width="100">部门</td>
	<td width="110">跟投类型</td>
	<td width="100">平衡额度<br>(不含杠杆)(万元)</td>
	<td width="70">分红批次</td>
	<td width="100">分红日期</td>
	<td width="80">分红金额<br>(万元)</td>
	<td width="150">分红帐号</td>
	<td width="70">备注</td>
	*/
	if(bonusList && bonusList.length > 0){
		var tempHtml = "";
		$.each(bonusList, function(ind, val){
			tempHtml +=
			'<tr><td height="35">'+(ind+1)+'</td>'+
			'<td>'+val.FNAME+'</td>'+
			'<td>'+val.FSTATE+'</td>'+
			'<td>'+(val.FCONFIRMAMOUNT)+'</td>'+
			'<td>'+val.FBONUSTIMES+'</td>'+
			'<td>'+(new Date(val.FBONUSDATE)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+(val.FBONUSAMOUNT)+'</td>'+
			'<td>'+(val.FBANKNO||"")+'</td>'+
			//'<td>'+(val.completeSubscribeRecord||"")+'</td>'+
			'<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#bonusTbody").html(tempHtml);
	}
}

function getSubscribeList(){	
	$.ajax({
		type:'get',//可选get
		url:'/investment/subscribe/queryAllUnComplete.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"projectId":projectId,
			"startPage":0,
			"endPage":999
		},
		success:function(msg){
			if(msg.success){
				subscribeList=msg.dataDto;
				loadSubList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadSubList(){
	if(subscribeList && subscribeList.length > 0){
		$("#bonusPagination").pagination(subscribeList.length, {
            items_per_page: 5,
            num_display_entries: 2,
            num_edge_entries: 2,
            callback: pageselectCallback,
            load_first_page: true,
            prev_text:"上一页",
            next_text:"下一页"
        });

	}
}

function pageselectCallback(v,d,s){
	$("#subscribeTbody").empty();
	var tempHtml = "";
	// $.each(subscribeList, function(ind,val){
	var sind = v*5;
	var leng = (sind+5)>subscribeList.length?subscribeList.length:sind+5;
	var val = null;
	for(var ind=sind;ind<leng;ind++){
		val = subscribeList[ind];
		tempHtml += 
		'<tr id="row_'+ind+'"><td height="35">'+(ind+1)+'</td>'+
		'<td>'+val.uName+'</td>'+
		'<td>'+val.projectName+'</td>'+
		'<td class="subInp">'+(val.contributiveConfirmAmount+val.contributiveConfirmAmount)+'</td>'+
		'<td><select class="typeInp"><option value="集团强投包">集团强投包</option><option value="集团选投包">集团选投包</option></select></td>'+
		'<td><input class="timesInp" value="1" /></td>'+
		'<td><input class="bonusamtInp" value="5" /></td>'+
		'<td><a class="addBonusBtn" ind="'+ind+'" href="javascript:void(0)">保存</a></td></tr>';
	// });
	}
	$("#subscribeTbody").html(tempHtml);
}

function addBonusFunc(){
	// debugger
	var _ind = $(this).attr("ind");
	var _dataObj = subscribeList[_ind];
	var _$rowObj = $("#row_"+_ind);

	var _typeVal = _$rowObj.find(".typeInp").val();
	var _subamtVal = _$rowObj.find(".subInp").text();
	var _timesVal = _$rowObj.find(".timesInp").val();
	var _bonusamtVal = _$rowObj.find(".bonusamtInp").val();

	// if(typeof(parseInt(_timesVal)) != "number" || _timesVal.length > 0){
	// 	alert("请输入有效的分红批次值!");
	// 	return false;
	// }else if(typeof(_bonusamtVal) != "number" || _bonusamtVal.length > 0){
	// 	alert("请输入有效的分红金额!");
	// 	return false;
	// }

	var _param = {
		"projectId":_dataObj.projectId,
		"userid":_dataObj.uid,
		"subscribeType":_typeVal,
		"subscribeAmount":_subamtVal,
		"bonusTimes":_timesVal,
		"bonusAmount":_bonusamtVal
	};
	// debugger;
	// return  false;
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/insert.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_param,
		success:function(msg){
			if(msg.success){
				alert("新增成功!");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function delBonusFunc(){
	var _ind = $(this).attr("ind");
	var _dataObj = bonusList[_ind];
	var ctx = "<?php echo site_url();?>";
	var fid_r = _dataObj.FID;
	$.ajax({
		type:'post',//可选get
		url:ctx+'BonusRecord/deleteBonus',
		dataType:'JSON',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			FID:fid_r,
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				getBonusList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function importBonusFunc(){
	/*$.ajaxFileUpload({
		url: '../BonusDetailController/callBonusImport.action', //用于文件上传的服务器端请求地址
		secureuri: false, //是否需要安全协议，一般设置为false
		fileElementId: 'bonusFileUp', //文件上传域的ID
		dataType: 'JSON', //返回值类型 一般设置为json
		data:{
			"filePath":"d://BonusDetail.xlsx"
		},
		success: function (data, status){  //服务器成功响应处理函数
			
			if(status == "success"){
				getBonusList();
				alert("导入成功!");
			}else{
				alert(data.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert(e);
		}
	})*/

	var ctx = "<?php echo site_url();?>";
	$.ajaxFileUpload({
		type:'post',//可选get
		url: ctx+'/BonusRecord/inputXLS', //用于文件上传的服务器端请求地址
		secureuri: false, //是否需要安全协议，一般设置为false
		fileElementId: 'file', //文件上传域的ID
		dataType: 'JSON', //返回值类型 一般设置为json
		data:{
			// "filePath":"d://BonusDetail.xlsx"
		},
		success: function (data, status){  //服务器成功响应处理函数			
			if(status == "success"){
				alert("导入分红成功!");
				getBonusList();
				//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
			}else{
				alert("1:"+data.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert("2:"+e);
		}
	})

	/**
	var _filePath = $("#bonusFileUp").val();
	//var _realPath = getPath(_filePath,this);
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/callBonusImport.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"filePath":_filePath||"d://BonusDetail.xlsx"
		},
		success:function(msg){
			if(msg.success){
				alert("导入成功!");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
	    	alert(errorThrown);       
	    }
	})
	
	**/
}
function callDialog(){
	$("#dialogBgLayer").show();
	$("#dialogLayer").show();
}
function hideDialog(){
	$("#dialogBgLayer").hide();
	$("#dialogLayer").hide();
	$("#searUserInp").val("");
}

function getPath(obj,fileQuery){ 
	if(window.navigator.userAgent.indexOf("MSIE")>=1){ 
		 obj.select();
		   return document.selection.createRange().text;
	} 
	else{ 
		var file =fileQuery.files[0];  
		var reader = new FileReader();  
		reader.onload = function(e){ 
		obj.setAttribute("src",e.target.result);
	   } 
	  return reader.readAsDataURL(file);  
	  } 
	} 

</script>
</head>
<body id="rightLayer">
<div id="searchLayer">
	<!-- <button id="callBonusDialog" class="btnSTY">新增分红</button> -->
	<button id="exportSubBtn" class="btnSTY">导出分红模板</button>
	<button id="importBtn" class="btnSTY">导入分红</button>
	<button id="exportBonusBtn" class="btnSTY">导出分红</button>
	<input  id="noInp" style="width:70px; float:left" placeholder="分红批次" />
	<input  id="noAmount"  style="width:70px; float:left" placeholder="分红总额" />
	<!-- <button id="callBonusDialog" class="btnSTY">新增分红</button> -->
	<button id="autobonus" class="btnSTY">生成分红明细</button>

	<input type="file" id="file" name="file" style="left:90px; " class="displayNone">
	分红日期：<input id="sDateInp" readonly class="dateSTY"   style="width:100px" />至<input id="eDateInp" readonly class="dateSTY" style="margin-right: 20px;width:100px" />
	<input id="searTextInp"  style="width:100px" placeholder="项目名或认购人" />
	<button id="searTextBtn">搜索</button>
	<button id="clearTextBtn">清空</button>
</div>

<table id="bonusTable" border="1" width="100%"><thead><tr>
	<td height="34" width="40">序号</td>
	<td width="100">跟投人</td>
	<td width="110">区域/总部</td>
	<td width="100">认购金额</td>
	<td width="70">分红批次</td>
	<td width="100">分红日期</td>
	<td width="80">分红金额<br>(万元)</td>
	<td width="150">分红帐号</td>
	<!--td width="70">备注</td-->
	<td>操作</td>
</tr></thead>
<tbody id="bonusTbody">
	<!-- <tr><td height="35">1</td>
		<td>张三</td>
		<td>合肥高新项目</td>
		<td>集团强投包</td>
		<td>23</td>
		<td>1</td>
		<td>2014-09-01</td>
		<td>5</td>
		<td><a href="javascript:void(0)">删除</a></td></tr> -->
</tbody></table>
</body>
</html>