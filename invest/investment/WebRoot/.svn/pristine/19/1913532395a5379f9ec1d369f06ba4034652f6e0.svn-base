// 下拉框定时器
var tabTimer1,timerFlag,tabTimer2,timerFlag2;
var currUser = "1001";
var currAccountName = "admin";
var pageObj = {
	"0": "index",
	"1": "projectList",
	"2": "personalCenter",
	"3": "followRules",
	"4": "helpCenter",
	"5": "projectList",
	"6": "projectList",
	"7": "completed",
	"12": "payInDetail",
	"8": "bonusDetail",
	"9": "personalInfo",
	"10": "projectList",
	"11": "newsList"
};

$(function(){
	initHeaderListeners();
	currUser = $("#loginInp").val();
	currAccountName = $("#accountnameInp").val();

	if(!currUser){
		$("#showLogin").text("登录").attr("href","login.jsp");
		$("#resetLogin").text("");
	}

	$("#loginBack").click(loginBackFunc);

	$("#resetLogin").click(loginOut);
});

function initHeaderListeners(){

	$("#navigation ul li").hover(function(){
		$(this).addClass("focusOn");

		var ind = $(this).attr("ind");
		if("personalCenter" == pageObj[ind]){
			timerFlag = true;
			window.clearTimeout(tabTimer1);
			// 个人信息下拉框
			var _left = $(this).offset().left;
			var _top = $(this).offset().top+35;
			var _width = $(this).outerWidth();

			$("#personalSelector").css({"top":_top,"left":_left,"width":_width}).show();
		}else if("projectList" == pageObj[ind] && ind == "1"){
			timerFlag2 = true;
			window.clearTimeout(tabTimer2);
			// 项目信息下拉框
			var _left = $(this).offset().left;
			var _top = $(this).offset().top+35;
			var _width = $(this).outerWidth();
			$("#projectSelector").css({"top":_top,"left":_left,"width":_width}).show();
		}
	}, function(){
		var ind = $(this).attr("ind");
		// if(naviInd != ind) 
		$(this).removeClass("focusOn");
		if("personalCenter" == pageObj[ind]){
			timerFlag = false;
			tabTimer1 = window.setTimeout(function(){
				if(!timerFlag) $("#personalSelector").hide();
			},100);
		}else if("projectList" == pageObj[ind] && ind == "1"){
			timerFlag2 = false;
			tabTimer2 = window.setTimeout(function(){
				if(!timerFlag2) $("#projectSelector").hide();
			},100);
		}
	}).click(function(){
		$("#navigation ul li").removeClass("focusOn");
		$(this).addClass("focusOn");

		skipPages($(this).attr("ind"));
	});

	$("#personalSelector li").hover(function(){
		timerFlag = true;
		$(this).addClass("focusOn");
		window.clearTimeout(tabTimer1);
		return false;
	},function(){
		$(this).removeClass("focusOn");
		timerFlag = false;
		tabTimer1 = window.setTimeout(function(){
			if(!timerFlag) $("#personalSelector").hide();
		},100);
	}).click(function(){
		skipPages($(this).attr("ind"));
	});

	$("#projectSelector li").hover(function(){
		timerFlag2 = true;
		$(this).addClass("focusOn");
		window.clearTimeout(tabTimer2);
		return false;
	},function(){
		$(this).removeClass("focusOn");
		timerFlag2 = false;
		tabTimer2 = window.setTimeout(function(){
			if(!timerFlag2) $("#projectSelector").hide();
		},100);
	}).click(function(){
		skipPages($(this).attr("ind"));
	});

	$("#header #logo").click(function(){
		location.href="index.jsp";
	});
}

function skipPages(_pageInd){
	var _url = pageObj[_pageInd]+".jsp";
	if(_pageInd == "6"){
		// 未完成认购列表携带参数
		_url += "?isPerson=yes";
	}
	location.href = _url;
}

function loginOut(){
	$.ajax({
		type:'post',//可选get
		url:'../userController/loginOut.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				location.href = "login.jsp"
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	})
}

function loginBackFunc(ev){
	$.ajax({
		type:'post',//可选get
		url:'../UserProjectRelateController/getRelateByUserId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{"projectId":""},
		success:function(msg){
			if(currUser == "1001" || (msg.success && msg.dataDto.length > 0)){
				location.href = "../back/index.jsp";
			}else{
				alert("当前登录用户没有权限!");
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});

	// if(currUser && currUser == "1001"){
	// 	location.href = "../back/index.jsp";
	// }
	// else{
	// 	ev.stopPropagation();
	// 	alert("当前登录用户没有权限!");
	// }
}