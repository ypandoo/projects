<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/ajaxFileUpload.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/mobileFix.mini.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/exif.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/lrz.js')?>"></script>

<!-- <link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css">
<script type="text/javascript" src="application/views/plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="application/views/plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="application/views/plugins/dateFormat.js"></script> -->
<style type="text/css">

.displayNone{display: none;}
.tip_STY{color: red;font-size: 1em;}
#rightLayer input[readonly='true']{background: #e8e8e8;border: 1px solid #BDBDBD;}
#rightLayer .editTitle{height: 30px;line-height: 30px;padding: 0px;/*background: #E0DBDB;border-bottom: 1px solid #949292;*/width: 15%;border-radius:4px 4px 2px 2px;margin:5px 0px 0px;cursor: pointer;font-weight: bold;}
#rightLayer .editTitle img{margin: 0px 10px;}
#rightLayer .editor{width:99%;min-height: 100px;margin: 0px auto;border: 1px solid #E0DBDB;overflow: hidden;padding: 5px;}
#rightLayer .editor .tdTitle{width: 13%;text-align: right;padding-right: 10px;font-size: 0.8em;}
#rightLayer .editor input{width: 45%;padding:0px 5px;margin: 3px 0px;}
#rightLayer .editor textarea{height:100px;width: 45%;resize:none;padding: 5px;margin: 3px 0px;}
#rightLayer .btnBox button{margin:10px 5px;}
#rightLayer #forceTable, #rightLayer #subTable{border-spacing: 1px; border-collapse: collapse;border:1px solid #C0BEBE;font-size: 0.9em;}
#rightLayer #forceTable .trTitle, #rightLayer #subTable .trTitle{background: url(application/views/back/images/thead_bg.png);color: #727070;}
#rightLayer #forceTable td, #rightLayer #subTable td{text-align: center;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody td, #rightLayer #subTable tbody td{height: 30px;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody input, #rightLayer #subTable tbody input{padding: 0px 3px;width: 70%;text-align: center;font-size: 14px;}

#forceDialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#forceDialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#forceDialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 750px;height: 360px;margin: 70px auto;}
#forceDialogLayer .dialogSTY .tipTitle{float:left;padding: 8px 15px;}
#forceDialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#forceDialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#forceDialogLayer .dialogSTY .contentDiv{width: 96%;height: 275px;margin: 3px auto;border: 0px solid #e8e8e8;overflow: hidden;}
#forceDialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#forceDialogLayer .dialogSTY .contentDiv table thead{background: url(application/views/back/images/thead_bg.png);}
#forceDialogLayer .dialogSTY .contentDiv table td{padding: 3px 5px;text-align: center;border: 1px solid #e8e8e8;}
#forceDialogLayer .dialogSTY .contentDiv table input{padding: 0px 3px;margin: 0px;width: 70px;text-align: center;}
#forceDialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#forceDialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#forceDialogLayer button{width: 50px;height: 25px;margin: 0px 5px;}

#ul-pics li {
    width: 32%;
    float: left;
    /* height: 300px; */
    margin-right: 1%;
    border: 1px solid #CCCCCC;
    margin-top: 1%;
}

input#item_pic {
	width: 200px;
}

.deletePic
{
	text-align: right;
	color: grey;
	font-size: 12px;
	margin-right: 10px
}


.file {
    position: relative;
    display: inline-block;
    background: #D0EEFF;
    border: 1px solid #99D3F5;
    padding: 4px 12px;
    overflow: hidden;
    color: #1E88C7;
    text-decoration: none;
    text-indent: 0;
    line-height: 20px;
}
.file input {
    position: absolute;
    font-size: 14px;
    right: 0;
    top: 0;
    opacity: 0;
}
.file:hover {
    background: #AADFFD;
    border-color: #78C3F3;
    color: #004974;
    text-decoration: none;
}
</style>
<script type="text/javascript">



$(function(){
		var projectId =getReqParam('projectid');
		$("#master_projectId").val(projectId);
		$('.url').val(window.location.href);
		getMainPic();
		getPics();
});

function getMainPic()
{
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'Pic/getMainImage',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				//$("#projectInp").val(msg.data[0].FNAME);
				if (msg.data.length > 0) 
				{
					$("#main_pic").attr("src",ctx+"images/"+msg.data[0].FNAME);
				};
			}else{
				alert("Get main pic failed: "+msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function getPics()
{
	var ctx="<?php echo site_url();?>";
	var projectId =getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'Pic/getAllProjectImage',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				//$("#projectInp").val(msg.data[0].FNAME);
				/*
				<li>
					<div><img src="http://localhost/application/views/front/img/title.jpg" width="100%"></div>
					<div><p class="deletePic" ><a onclick="delPic(this.id)">删除照片</a></p></div>
				</li>
				*/
				var picList = msg.data;
				var tempHtml = "";

				$.each(picList, function(ind, val){
					tempHtml += ('<li><div><img src="'+ctx+"images/"+val.FNAME+'" width="100%"></div>');
					tempHtml += ('<div><p class="deletePic" ><a onclick="delPic('+val.FID+')">删除照片</a></p></div></li>');
				});
				$("#ul-pics").html(tempHtml);

			}else{
				alert("aa"+msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

		// 导入缴款数据
	/*function importBtn_click(){
		$("#file").click();
	}

	/*$("#importBtn").click(function(){
		$("#file").click();
	});*/

	/*$("#file").live("change", importPIFunc); 

	function importPIFunc(){
		if($("#file").val() == ""){
			return false;
		}

		var projectId = getReqParam('projectId');
		var ctx = "<?php echo site_url();?>";
        var _obj = {"projectId": projectId};
		$.ajaxFileUpload({
			type: 'POST',
			url: ctx+'Pic/updateImage', //用于文件上传的服务器端请求地址
			secureuri: false, //是否需要安全协议，一般设置为false
			fileElementId: 'file', //文件上传域的ID
			dataType: 'json', //返回值类型 一般设置为json
			data:_obj,
			success: function (msg, status){  //服务器成功响应处理函数			
				if(msg.success){
					alert("导入成功!");
					getCover();
					//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
				}else{
					alert("1:"+msg.error);
				}
			},
			error: function (data, status, e){//服务器响应失败处理函数		
				alert("2:"+e);
			}
		})
	}

	$("#importBtn1").click(function(){
		$("#file1").click();
	});

	$("#file1").live("change", importPIFunc1); 

	function importPIFunc1(){
		if($("#file").val() == ""){
			return false;
		}
		var ctx = "<?php echo site_url();?>";
		$.ajaxFileUpload({
			url: ctx+'/Pics/uploadPic', //用于文件上传的服务器端请求地址
			secureuri: false, //是否需要安全协议，一般设置为false
			dataType: 'JSON', //返回值类型 一般设置为json
			data:{
				// "filePath":"d://BonusDetail.xlsx"
			},
			success: function (data, status){  //服务器成功响应处理函数			
				if(status == "success"){
					alert("导入成功!");
					getPics();
					//$("#file").prop("outerHTML", $("#piFileUp").prop("outerHTML"));
				}else{
					alert("1:"+data.error);
				}
			},
			error: function (data, status, e){//服务器响应失败处理函数		
				alert("2:"+e);
			}
		})
	}*/

function delPic(id)
{
	var ctx = "<?php echo site_url();?>";
	$.ajax({
		type:'post',
		url: ctx+'Pic/deletePic', //用于文件上传的服务器端请求地址
		dataType: 'JSON', //返回值类型 一般设置为json
		data:{
			FID:id
		},
		success: function (msg){  //服务器成功响应处理函数			
			if(msg.success){
				alert("删除成功!");
				getPics();
			}else{
				alert("Del Pic:"+data.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

//var main_base64;

$("#main_pic_upload").live("change", upload_main); 
function upload_main(){
            lrz(this.files[0], {width: 280}, function (results) {
                // 你需要的数据都在这里，可以以字符串的形式传送base64给服务端转存为图片。
                console.log("图片压缩成功"+results);
                //main_base64 = results.base64;

                var projectId = getReqParam('projectId');
				var ctx = "<?php echo site_url();?>";
		        var _obj = {"projectId": projectId, "pic_data":results.base64};
		        $.ajax({
		        	 type: 'POST', 
		             url: ctx+'Pic/updateImage', 
		             data: _obj, 
		             success: function(data) 
			        {
					   //alert('上传成功');
					   getMainPic();
					},
					error: function (XMLHttpRequest, textStatus, errorThrown)
					 {
					        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
					 }, 
		            dataType: "json" });
				      });
 }

$("#pic_upload").live("change", upload_pic); 
function upload_pic(){
            lrz(this.files[0], {width: 280}, function (results) {
                // 你需要的数据都在这里，可以以字符串的形式传送base64给服务端转存为图片。
                console.log("图片压缩成功"+results);
                //main_base64 = results.base64;

                var projectId = getReqParam('projectId');
				var ctx = "<?php echo site_url();?>";
		        var _obj = {"projectId": projectId, "pic_data":results.base64};
		        $.ajax({
		        	 type: 'POST', 
		             url: ctx+'Pic/addImage', 
		             data: _obj, 
		             success: function(data) 
			        {
					   //alert('上传成功');
					   getPics();
					},
					error: function (XMLHttpRequest, textStatus, errorThrown)
					 {
					        	 sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
					 }, 
		            dataType: "json" });
				      });
 }

</script>
</head>
<body id="rightLayer">
<div id="basic" class="editTitle"><img src="<?php echo site_url();?>application/views/back/images/arrow_down.png" />项目封面图</div>
		<div><img src="<?php echo site_url();?>images/default.jpg" width="600px" id="main_pic"></div>

		<!--input type="file" id="file" name="file" class="displayNone">
		<button id="importBtn" onclick="importBtn_click()" 
		class="btnSTY" style="margin:10px 10px 10px 0px; padding:5px">修改封面图片</button-->

		<!--form method="post" action="<?=site_url()?>Pic/updateImage/" enctype="multipart/form-data" /-->
		    <div style="margin:10px 0 0.5em 0em;">
		    	<!--input type="hidden" name="projectId" id="" value=""/-->
		        <a href="javascript:;" class="file"><input id="main_pic_upload" type="file" name="file"/>修改封面图片</a>
		        <!--input type="submit" value=" " class="button" />上传修改-->
		        <input name="url" type="hidden"  style="display:none" class="url" />
		    </div>
		<!--/form-->


<div id="basic" class="editTitle"><img src="<?php echo site_url();?>application/views/back/images/arrow_down.png" />项目图库</div>
<ul id="ul-pics">
</ul>
<div style="clear:both">
	<div style="margin:10px 0 0.5em 0em;">
		<a href="javascript:;" class="file"><input id="pic_upload" type="file" name="file"/>上传图片</a>
		<input name="url" type="hidden"  style="display:none" class="url" />
	</div>
</div>

</html>