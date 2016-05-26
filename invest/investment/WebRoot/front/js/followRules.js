// 导航下标
var naviInd = "1";
// 页签下标
var tabInd = "scheme";
var dataList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	dataList = [{},{},{},{},{},{},{},{},{},{}];
}

function initListeners(){
	initHeaderListeners();

	$("#titleTab .tabSTY").click(function(){
		$("#titleTab .tabSTY").removeClass("focusOn");
		$(this).addClass("focusOn");
		$("#"+tabInd+"_info").hide();

		tabInd = $(this).attr("anchor");
		$("#"+tabInd+"_info").show();
	});
}

function initPages () {
}