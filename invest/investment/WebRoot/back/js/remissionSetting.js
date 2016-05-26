$(function(){
	initPageListener();
	fetchRemissionUserList();
});

function initPageListener(){
	$("#addBtn").click(function(){
		openAddPage();
	});
}

function openAddPage(){
	fetchRemissionUserListLimit(null, true);
//	$("#addDialogLayer").show();
}

function fetchRemissionUserListLimit(userName, loadPage){
	$.ajax({
		type:'post',//可选get
		url:'../userController/remissionUser/list/limit.action',
		contentType: "application/json;charset=utf-8",
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:userName,
		success:function(msg){
			if(msg.success && msg.dataDto){
				if(loadPage){
					openMask(msg.dataDto);
				}else{
					fillAddPageTable(msg.dataDto);
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

function openMask(list){
	//整个页面的宽高
	var pageWidth=document.body.scrollWidth;
	var pageHeight=document.body.scrollHeight;
	//获取页面的可视区域高度和宽度
	var viewHeight=document.documentElement.clientHeight;
	var viewWidth=document.documentElement.clientWidth;
	
	var maskDiv = document.createElement("div");
	maskDiv.id = "maskLayer";
	maskDiv.style.height = pageHeight + "px";
	maskDiv.style.width = pageWidth + "px";
	document.body.appendChild(maskDiv);
	
	var addPage = document.createElement("div");
	addPage.id = "addPage";
	addPage.innerHTML = generatePage(list);
	document.body.appendChild(addPage);
	//获取新增页面的宽高
	var addPageHeight = addPage.offsetHeight;
	var addPageWidth = addPage.offsetWidth;
	addPage.style.left = pageWidth/2 - addPageWidth/2 + "px";
	addPage.style.top = viewHeight/2 - addPageHeight/2 + "px";
	initAddPage();
}

function fillAddPageTable(userList){
	$("#addPageMain #contentTab table tbody").html(generateTable(userList));
}

function initAddPage(){
	$("#addPageMain #addPageTop #btnSerach").click(function(){
		searchRemissionUser();
	});
	
	$("#addPageMain #addPageFooter #addPageSaveBtn").click(function(){
		saveRemissionUserList();
	});
	
	$("#addPageMain #addPageFooter #addPageCancelBtn").click(function(){
		closeAddPage();
	});
	
	$("#addPageMain #addPageTop #userName").keypress(function(event){
        if(event.keyCode == "13") {
        	searchRemissionUser();
        }
    });
}

function searchRemissionUser(){
	var userName = $("#addPageMain #addPageTop #userName").val();
	fetchRemissionUserListLimit(userName, false);
}

function saveRemissionUserList(){
	var rows = $("#addPageMain #contentTab table tbody tr");
	var userListEditData = [];
	debugger;
	for (var i = 0; i < rows.length; i++) {
		var row = rows[i];
		var userId = $(row).attr("userId");
		var remissionCount = $(row).find("input").val();
		if(!isNotNegativeInteger(remissionCount)){
			alert("第" + (i + 1) + "行豁免次数非法！");
			return false;
		}
		if(parseInt(remissionCount, 10) == 0){
			alert("第" + (i + 1) + "行豁免次数为0！");
			return false;
		}
		
		var userInfo = {"uid":userId, "remissionCount":remissionCount};
		userListEditData.push(userInfo);
	}
	remoteSave(userListEditData);
}

function remoteSave(userListEditData){
	$.ajax({
		type:'post',//可选get
		url:'../userController/remissionUser/updateBacth.action',
		contentType: "application/json;charset=utf-8",
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:JSON.stringify(userListEditData),
		success:function(msg){
			if(msg.success){
				alert("保存成功！");
				closeAddPage();
				fetchRemissionUserList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function isNotNegativeInteger(number){
	return new RegExp(/^(0|[1-9]\d*)$/).test(number);
}

function closeAddPage(){
	$("#maskLayer").remove();
	$("#addPage").remove();
}

function generatePage(list){
	var result = "<div id='addPageMain'>" +
							"<div id='addPageTop'>" +
								"<input id='userName' placeholder='搜索用户名'/>" +
								"<button id='btnSerach'>查询</button>" +
							"</div>" +
							"<div id='contentTab'>" +
								"<table border:1px solid #C0BEBE>" +
									"<thead>"+
										"<tr>"+
											"<td>序号</td>"+
											"<td>姓名</td>"+
											"<td>部门</td>"+
											"<td>电话</td>"+
											"<td>备注</td>"+
											"<td style='padding:0px;'>豁免次数</td>"+
										"</tr>"+
									"</thead>"+
									"<tbody>"+
										generateTable(list) + 
									"</tbody>" +
								"</table>" +
							"</div>" +
							"<div id='addPageFooter'>" +
								"<button id='addPageSaveBtn'>保存</button>" +
								"<button id='addPageCancelBtn'>取消</button>" +
							"</div>" +
						"</div";
	return result;
}

function generateTable(list){
	var result = "";
	for (var i = 0; i < list.length; i++) {
		var user = list[i];
		result = result + "<tr userId='" + user.uid + "'>" +
									"<td>" + (i + 1) + "</td>" +
									"<td>" + (user.uname || "") + "</td>" +
									"<td>" + (user.service || "") + "</td>" +
									"<td>" + (user.mobilePhone || "") + "</td>" +
									"<td>" + (user.samaccountname || "") + "</td>" +
									"<td style='padding:0px;'>" +
										"<input value ='" + (user.remissionCount)  + "'>" +
									"</td>" +
								"</tr>";
	}
	return result;
}

function fetchRemissionUserList(){
	$.ajax({
		type:'post',//可选get
		url:'../userController/remissionUser/list.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				remissionUserList = msg.dataDto;
				loadUserList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadUserList(){
	if(remissionUserList){
		$("#remissionTable tbody > tr").remove();
		for (var i = 0; i < remissionUserList.length; i++) {
			var user = remissionUserList[i];
			$("#remissionTable tbody").append(generateTableRow(user, (i + 1)));
		}
	}
}

function generateTableRow(user, rowNum){
	var result = "<tr userId='" + user.uid + "'>" +
							"<td>" + rowNum + "</td>" +
							"<td>" + (user.uname || "") + "</td>" +
							"<td>" + (user.service || "") + "</td>" +
							"<td>" + (user.mobilePhone || "") + "</td>" +
							"<td>" + (user.samaccountname || "") + "</td>" +
							"<td>" +
								"<input value ='" + (user.remissionCount || "")  + "' disabled=disabled>" +
							"</td>" +
							"<td>" + (user.usedRemissionCount) + "</td>" +
							"<td>" +
								"<a onClick='saveRemissionUser(this)'>保存</a>" +
								"<a onClick='modifyRemissionUser(this)'>修改</a>" +
								"<a onClick='clearRemissionUser(this)'>清除</a>" +
							"</td>" +
						"</tr>";
	return result;
}

function saveRemissionUser(source){
	var userId = $(source.parentNode.parentNode).attr("userId");
	var remissionCount = $(source.parentNode.parentNode).find("td input").val();
	updateRemissionCount(userId, remissionCount);
}

function modifyRemissionUser(source){
	$(source.parentNode.parentNode).find("td input").removeAttr("disabled");
}

function clearRemissionUser(source){
	if(window.confirm("豁免次数将清空！")){
		var userId = $(source.parentNode.parentNode).attr("userId");
		updateRemissionCount(userId, 0);
	}
}

function updateRemissionCount(userId, remissionCount){
	$.ajax({
		type:'post',//可选get
		url:'../userController/remissionUser/update.action',
		contentType: "application/json;charset=utf-8",
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		cache:false,
		data:JSON.stringify({
			"uid":userId, 
			"remissionCount": remissionCount
			}),
		success:function(msg){
			if(msg.success){
				alert("修改成功！");
				fetchRemissionUserList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
