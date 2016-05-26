
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护平台 - 权限分配</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>


<style type="text/css">
#permissionSet button, #dialogLayer button{width: 50px;height: 25px;margin: 0px 5px;}
#permissionSet .layerSTY{float: left;margin:20px 0px 0px 35px;width: 250px;}
#permissionSet .mngLayerSTY{width: 640px;}
#permissionSet .titleSTY{font-size: 16px;font-weight: bold;overflow: hidden;height: 25px;}
#permissionSet .titleSTY #addMngBtn{font-size: 12px;font-weight: 600;cursor: pointer;line-height: 30px;float: right;color:#21B4F6;}
#permissionSet .listSTY{width: 100%;border: 2px solid #e8e8e8;height: 300px;overflow-y: scroll;}
#permissionSet #proList .proListSTY{/*width: 100%;*/height: 30px;line-height: 30px;padding: 0px 5px;cursor: pointer;font-size: 1.1em;border-bottom: 1px solid #e8e8e8;}
#permissionSet #proList .focusOn{background: #FFFDD6;}
#permissionSet #managerList .mngListSTY{/*width: 100%;*/height: 30px;line-height: 30px;padding: 0px 5px;cursor: pointer;border-bottom: 1px solid #e8e8e8;}
#permissionSet #managerList .mngListSTY .delBtn{margin-left: 7px;display: none;}
#permissionSet #managerList .mngListSTY .ckbox{float: right;}
#permissionSet #managerList .mngListSTY .ckSTY{width: 15px;height: 15px;padding: 0px;vertical-align: middle;}
#dialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#dialogLayer{position: fixed;width: 100%;height: 100%;top: 50px;left: 0;}
#dialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 750px;height: 470px;margin: 70px auto;}
#dialogLayer .dialogSTY .tipTitle{float:left;padding: 8px 15px;}
#dialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#dialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#dialogLayer .dialogSTY .contentDiv{width: 96%;height: 385px;margin: 3px auto;border: 0px solid #e8e8e8;overflow: hidden;}
#dialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#dialogLayer .dialogSTY .contentDiv table thead{background: url(images/thead_bg.png);}
#dialogLayer .dialogSTY .contentDiv table td{padding: 3px 5px;border: 1px solid #e8e8e8;}
#dialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#dialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;vertical-align: middle;}
#dialogLayer button{width: 50px;height: 25px;margin: 0px 5px;padding:0px 5px;}
input#searUserInp {
    width: 150px;
    height: 40px;
    line-height: 40px;
    padding: 0px 5px;
    margin: 3px;
}

#dialogLayer button {
    width: 80px;
    height: 40px;
    margin: 0px 5px;
    padding: 0px 5px;
}

#dialogLayer .dialogSTY {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 5px;
    width: 1000px;
    height: 500px;
    margin: 70px auto;
}
</style>
<script type="text/javascript">
var proInd = "0";
// 项目列表数据
var permProList = [];
// 当前项目下的管理员名单
var mngUserList = [];
var mngObj = {};
// 所有人员列表数据
var allUserList = [];
// 权限组
var permArr = [
	"基础信息",
	"动态新闻",
	"认购核准",
	"缴款确认",
	"分红明细",
];
// 临时数据存储对象
var tempMngObj = {};
var tempDelObj = {};
var tempAddObj = {};
var tempUpdObj = {};
$(function(){
	initPermListener();
	initPermPages();
});

var uid = $('#uid').attr('uid');
function initPermListener (argument) {
	$("#proList .proListSTY").live("mouseover",function(){
		if(!$(this).hasClass("focusOn")){
			$(this).addClass("focusOn");
		}
	}).live("mouseout",function(){
		if(!($(this).attr("ind") == proInd)){
			$(this).removeClass("focusOn");
		}
	}).live("click",function(){
		$("#proList .proListSTY").removeClass("focusOn");
		$(this).addClass("focusOn");
		proInd = $(this).attr("ind");
		getMngUserData();
	});

	$("#managerList .mngListSTY").live("mouseover",function(){
		$(this).find("a").show();
	}).live("mouseout",function(){
		$(this).find("a").hide();
	});

	$("#managerList .mngListSTY input[class='ckSTY']").live("click",editPerm);
	$("#managerList .mngListSTY .delBtn").live("click",function(){
		delMngUser($(this).attr("uid"));
	});

	$("#searUserBtn").click(getAllUserData);
	$("#addMngBtn").click(function(){
		callDialog();
	});
	$("#okBtn").click(function(){
		saveMngUser();
	});
	$("#cancelBtn").click(function(){
		hideDialog();
	});

	$("#allUserTbody input[name=userCk]").live("click", function(){
		var _cked = $(this).attr("checked");
		var _uid = $(this).attr("uid");
		if(_cked){
			$(this).attr("checked","checked");
			// 默认给所有菜单权限
			$(this).parent().nextAll(".permTd").find(".ckSTY").each(function(){
				$(this).attr("checked","checked");
			});

			if(tempMngObj[_uid]){
				if(tempDelObj[_uid]){
					delete tempDelObj[_uid];
				}
				tempUpdObj[_uid] = setAllPerm("1");
			}else{
				tempAddObj[_uid] = setAllPerm("1");
			}
		}else{
			$(this).removeAttr("checked");
			$(this).parent().nextAll(".permTd").find(".ckSTY").each(function(){
				$(this).removeAttr("checked");
			});

			if(tempMngObj[_uid]){
				tempDelObj[_uid] = setAllPerm("0");
			}else if(tempAddObj[_uid]){
				delete tempAddObj[_uid];
			}
		}
	})

	$("#allUserTbody input[name=permCk]").live("click", function(){
		var _cked = $(this).attr("checked");
		var _uid = $(this).attr("uid");
		var _temp = [];
		var _isValible = false;

		$(this).parent().find("input[name=permCk]").each(function(ind, val){
			if($(this).attr("checked") == "checked"){
				_temp[ind] = "1";
				_isValible = true;
			}else{
				_temp[ind] = "0";
			}
		});

		if(_cked){
			$(this).attr("checked","checked");
			$(this).parent().prevAll(".userTd").find("input[name=userCk]").attr("checked","checked");

			if(tempMngObj[_uid]){
				tempUpdObj[_uid] = _temp;
			}else{
				tempAddObj[_uid] = _temp;
			}
		}else{
			$(this).removeAttr("checked");

			if(!_isValible){
				// 勾被全部取消
				$(this).parent().prevAll(".userTd").find("input[name=userCk]").removeAttr("checked");
				if(tempMngObj[_uid]){
					tempDelObj[_uid] = _temp;
				}else{
					delete tempAddObj[_uid];
				}				
			}else{
				if(tempMngObj[_uid]){
					tempUpdObj[_uid] = _temp;
				}else{
					tempAddObj[_uid] = _temp;
				}
			}
		}
	});
}

function initPermPages(){
	getPermProjectList();
}
function editPerm(){
	var _tempUpdObj = {};
	var _flag = false;
	var _arr = [];
	var _cked = $(this).attr("checked");
	var _uid = $(this).attr("uid");
	$(this).parent().find(".ckSTY").each(function(ind, value){
		if($(this).attr("checked") == "checked"){
			_flag = true;
			_arr[ind] = "1";
		}else{
			_arr[ind] = "0";
		}
	});
	if(!_cked){
		if(_flag){
			$(this).removeAttr("checked");
		}else{
			$(this).attr("checked", "checked");
			return false;
		}
	}
	_tempUpdObj[_uid] = _arr;

	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'UserProjectRight/editUserProjectRight',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':permProList[proInd].FID,
			'delUserId':"",
			'addUserId':"",
			'updUserId':objConcatStr(_tempUpdObj)
		},
		success:function(msg){
			if(msg.success){
				// permProList=msg.dataDto;
				// loadPermProjectList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	});
}
function getPermProjectList(){
	// var ctx=$("#ctx").val();
	// var projectName=$("#projectNameList").val();
	var ctx="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Project/getProjectBack',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		// data:{'projectName':""},
		success:function(msg){
			if(msg.success){
				permProList=msg.data;
				loadPermProjectList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadPermProjectList(){
	$("#proList").empty();
	if(permProList && permProList.length > 0){
		getMngUserData();
		var tempHtml = "";
		$.each(permProList, function(ind, val){
			tempHtml +=
			'<div ind="'+ind+'" class="proListSTY '+(ind==0?"focusOn":"")+'">'+val.FNAME+'</div>';
		});
		$("#proList").html(tempHtml);
	}
}
function getMngUserData(_proid){
	mngUserList = [];
	var proid="";
	if(_proid){
		proid = _proid;
	}else if(permProList && permProList.length>0){
		proid = permProList[proInd].FID;
	}
	
	var ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'UserProjectRight/getProjectUserRightWithProjectID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':proid,
			"startPage":0,
			"endPage":999
		},
		success:function(msg){
			if(msg.success){
				mngUserList=msg.data;
				loadMngUserData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadMngUserData(){
	$("#managerList").empty();
	mngObj = {};
	if(mngUserList && mngUserList.length > 0){
		var tempHtml = "";
		var ckArr = [];
		$.each(mngUserList, function(ind, val){
			if(!mngObj[val.FID]){
				mngObj[val.FID] = val;
			}
			if(val.samaccountname == "admin"){
				tempHtml +=
				'<div class="mngListSTY">'+val.uname+'</div>';
			}else{
				ckArr = catPermissionArr(val);//val.permissionFlag?val.permissionFlag.split(""):setAllPerm("0");

				var permStr = "";
				for (var i = 0; i < permArr.length; i++) {
					permStr += '<input type="checkbox" class="ckSTY" uid="'+val.FUSERID+'" '+(isPermission2(ckArr,i)?"checked='checked'":"")+' />'+permArr[i]+'&nbsp;&nbsp;'
				};

				tempHtml +=
				'<div class="mngListSTY">'+val.FUSERNAME+'<a class="delBtn" uid="'+val.FUSERID+'" '+
					'href="javascript:void(0);"> x </a>'+
					'<span class="ckbox">'+ permStr +
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,0)?"checked='checked'":"")+' />基础信息&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,1)?"checked='checked'":"")+' />动态新闻&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,2)?"checked='checked'":"")+' />认购核准&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,3)?"checked='checked'":"")+' />缴款确认&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,4)?"checked='checked'":"")+' />分红明细&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,5)?"checked='checked'":"")+' />特别跟投&nbsp;&nbsp;'+
					// '<input type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,6)?"checked='checked'":"")+' />离职处理&nbsp;&nbsp;'+
					'</span></div>';				
			}
		});
		$("#managerList").html(tempHtml);
	}
}
function isPermission2(_arr,_ind){
	/*if (uid == '3896') 
	{
		return true;
	};*/
	if(!_arr){
		return false;
	}else if(_ind >= _arr.length){
		return false;
	}else if(_arr[_ind] != "0"){
		return true;
	}
	return false;
}
function getAllUserData(){
	var _nameVal = $.trim($("#searUserInp").val());
	var ctx = "<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'UserProjectRight/getAllUserRight',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'uname':_nameVal,
			'projectId':permProList[proInd].FID,
			"startPage":0,
			"pageSize":10
		},
		success:function(msg){
			if(msg.success){
				allUserList=msg.data;
				loadAllUserData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function catPermissionArr(val)
{
	/*FBASICS: false
FBONUSDETAIL: false
FID: "3"
FNEWS: false
FPAYCONFIRM: false
FSTATUS: false
FSUBSCRIPTION: false
FUSERNAME: "test1"
	"基础信息",
	"动态新闻",
	"认购核准",
	"缴款确认",
	"分红明细",*/
	return new Array(val.FBASICS, val.FNEWS, val.FSUBSCRIPTION, val.FSUBSCRIPTION, val.FBONUSDETAIL);
}

function loadAllUserData (argument) {

	/*
		FBASICS: false
FBONUSDETAIL: false
FNEWS: false
FPAYCONFIRM: false
FSTATUS: false
FSUBSCRIPTION: false
FUSERID: "3587"
FUSERNAME，FORG: "米琦"
	*/
	$("#allUserTbody").empty();
	if(allUserList && allUserList.length > 0){
		var tempHtml = "";
		var ckStr = "";
		var ckArr = [];
		$.each(allUserList, function(ind, val){
			ckStr = "";
			ckArr = setAllPerm("0");
			if(tempAddObj[val.FUSERID] || (tempMngObj[val.FUSERID] && !tempDelObj[val.FUSERID])){
				 ckStr = 'checked="checked"';
				 ckArr = catPermissionArrval(val); //.permissionFlag?val.permissionFlag.split(""):setAllPerm("1");
			}

			var permStr = "";
			for (var i = 0; i < permArr.length; i++) {
				permStr += '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.FUSERID+'" '+(isPermission2(ckArr,i)?"checked='checked'":"")+' />'+permArr[i];
				//if(i%3==0 && i>0 && i<permStr.length-1) permStr +="<br>";
				//else 
					permStr +="&nbsp;&nbsp;";
			};

			tempHtml +=
			'<tr><td class="userTd"><input name="userCk" type="checkbox" class="ckSTY" '+ckStr+' uid="'+val.FUSERID+'"></td>'+
			'<td>'+val.FUSERNAME+'</td>'+
			'<td>'+val.FNUMBER+'</td>'+
			'<td>'+val.FORG+'</td>'+
			'<td class="permTd">'+ permStr +
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,0)?"checked='checked'":"")+'/>基础信息&nbsp;&nbsp;'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,1)?"checked='checked'":"")+'/>动态新闻&nbsp;&nbsp;'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,2)?"checked='checked'":"")+'/>认购核准&nbsp;&nbsp;'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,3)?"checked='checked'":"")+'/>缴款确认<br>'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,4)?"checked='checked'":"")+'/>分红明细&nbsp;&nbsp;'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,5)?"checked='checked'":"")+'/>特别跟投&nbsp;&nbsp;'+
				// '<input name="permCk" type="checkbox" class="ckSTY" uid="'+val.uid+'" '+(isPermission(ckArr,6)?"checked='checked'":"")+'/>离职处理'+
			'</td></tr>';
		});
		$("#allUserTbody").html(tempHtml);
	}
}

function saveMngUser(){
	var _delUidStr = objConcatStr(tempDelObj);
	var _addUidStr = objConcatStr(tempAddObj);
	var _updUidStr = objConcatStr(tempUpdObj);
	
	ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		// url:'../UserProjectRelateController/deleteRelateByUserProject.action',
		url:ctx+'UserProjectRight/editUserProjectRight',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':permProList[proInd].FID,
			'delUserId':_delUidStr,
			'addUserId':_addUidStr,
			'updUserId':_updUidStr
		},
		success:function(msg){
			if(msg.success){
				alert("保存成功!");
				getMngUserData();
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

function delMngUser(_uid){	
	var _addUidStr = objConcatStr(tempAddObj);
	ctx ="<?php echo site_url() ?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'UserProjectRight/deleteRelateByUserProject',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':permProList[proInd].FID,
			'uid':_uid
		},
		success:function(msg){
			if(msg.success){
				getMngUserData();
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
	getAllUserData();
	tempMngObj = mngObj;
	$("#dialogLayer #proName").text(permProList[proInd].FNAME);
	$("#dialogBgLayer").show();
	$("#dialogLayer").show();
}
function hideDialog(){
	$("#dialogBgLayer").hide();
	$("#dialogLayer").hide();
	$("#searUserInp").val("");
	tempMngObj = {};
	tempAddObj = {};
	tempDelObj = {};
}
function objConcatStr(_obj){
	var _str = "";
	if(_obj){
		$.each(_obj, function(ind, val) {
			_str += ","+ind+":"+val.join("");
		});
		if(_str.length > 0) _str = _str.substring(1,_str.length);//截取第一个“,”
	}
	return _str;
}
function setAllPerm(_status){
	var _arr = [];
	for (var i = 0; i < permArr.length; i++) {
		_arr.push(_status);
	};
	return _arr;
}
</script>
</head>
<body>
<div id="permissionSet">
	<div id="proLayer" class="layerSTY">
		<div class="titleSTY">项目列表</div>
		<div id="proList" class="listSTY">
			<!-- <div ind="0" class="proListSTY focusOn">合肥高新</div> -->
		</div>
	</div>
	<div id="managerLayer" class="layerSTY mngLayerSTY">
		<div class="titleSTY">管理员名单<span id="addMngBtn">分配管理员</span></div>
		<div id="managerList" class="listSTY">
			<!-- <div class="mngListSTY">张三<a class="delBtn" uid="" href="javascript:void(0);"> x </a></div> -->
		</div>
	</div>
</div>
</body>
<div id="dialogBgLayer" style="display:none;"></div>
<div id="dialogLayer" style="display:none;">
	<div class="dialogSTY">
		<div class="searDiv">
			<div class="tipTitle">请为<span id="proName">合肥高新项目</span>分配管理员</div>
			<input id="searUserInp" placeholder="请输入用户名" /><button id="searUserBtn">搜索</button>
		</div>
		<div class="contentDiv"><table border="1" style="font-size:12px"><thead><tr>
			<td width="28"></td>
			<td width="80">中文名</td>
			<td width="100">帐号</td>
			<td width="100">组织</td>
			<td>权限</td>
		</tr></thead>
		<tbody id="allUserTbody">
			<!-- <tr><td>
				<input name="userCk" type="checkbox" class="ckSTY">
			</td><td>
				张三
			</td><td>
				合肥
			</td><td>
				区域总监
			</td></tr> -->
		</tbody></table></div>
		<div class="btnDiv"><button id="okBtn">确定</button><button id="cancelBtn">取消</button></div>
	</div>
</div>
</html>