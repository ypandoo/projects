// 导航下标
var naviInd = "1";
// 页签下标
var tabInd = "basic";
var projectId = null;
var forceList = null;
var basicInfo = null;
var schemeInfo = null;
var newsInfo = null;
var tabFlag = "";

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	projectId = getReqParam("proId");
	tabFlag = getReqParam("tabInd");
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

	$("#basic_info .moduleTitle").click(function(){
		var _id = $(this).attr("ind")
		var _display = $("#"+_id).css("display");
		var url = $('#site_url').text();
		if("none" == _display){
			$(this).find("img").attr("src", url+'application/views/front/images/arrow_down.png');
		}else{
			$(this).find("img").attr("src",url+'application/views/front/images/arrow_up.png');
		}
		$("#"+_id).toggle();
	});
}

function initPages () {
	getProjectInfo();
	getSchemeInfo();
	getForceList();
	getNewsList();

	$("#titleTab .tabSTY[anchor="+tabFlag+"]").click();
}

function getProjectInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../ProjectBasicController/getProjectById.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				basicInfo = msg.baseModel;
				$("#naviProName").text(msg.baseModel.projectName);
				$("#floorArea").text(msg.baseModel.floorArea+" 平方米");
				$("#structArea").text(msg.baseModel.structArea+" 平方米");
				$("#plotArea").text(msg.baseModel.plotArea);
				$("#saleStructArea").text(msg.baseModel.saleStructArea+" 平方米");
				$("#groundInp").text((new Date(msg.baseModel.groundDate)).format('yyyy-MM-dd'));
				$("#groundAmount").text(msg.baseModel.groundAmount+" 亿元");
				$("#groundType").text(msg.baseModel.groundType);
				$("#buildareaprice").text(msg.baseModel.buildareaprice +" 元/平方米");
				$("#groundPosition").text(msg.baseModel.groundPosition);
				$("#groundPositioning").text(msg.baseModel.groundPositioning);
				$("#groundPlanning").text(msg.baseModel.groundPlanning);
				$("#planFold").text(msg.baseModel.planFold+" 元/平方米");
				$("#planRent").text(msg.baseModel.planRent);
				$("#planIrr").text(msg.baseModel.planIrr+" %");
				$("#planGrossMargin").text(msg.baseModel.planGrossMargin+" %");
				$("#planMoic").text(msg.baseModel.planMoic);
				$("#stageStartInp").text((new Date(msg.baseModel.planStageStartDate)).format('yyyy-MM-dd'));
				$("#stageOpenInp").text((new Date(msg.baseModel.planStageOpenDate)).format('yyyy-MM-dd'));
				// $("#peakInp").text((new Date(msg.baseModel.planPeakeDate)).format('yyyy-MM-dd'));
				// $("#cashflowReturnInp").text((new Date(msg.baseModel.planCashflowReturnDate)).format('yyyy-MM-dd'));
				$("#returnDateInp").text(msg.baseModel.returndate+" 个月");				
				$("#deliverInp").text((new Date(msg.baseModel.planDeliverDate)).format('yyyy-MM-dd'));
				$("#carryoverInp").text((new Date(msg.baseModel.planCarryoverDate)).format('yyyy-MM-dd'));
				$("#liquidateInp").text((new Date(msg.baseModel.planLiquidateDate)).format('yyyy-MM-dd'));
				$("#planPropertyScheme").text(msg.baseModel.planPropertyScheme);
				$("#planFinanceCalculate").text(msg.baseModel.planFinanceCalculate);
				$("#corpPartnerBackground").text(msg.baseModel.corpPartnerBackground);
				$("#corpContributiveRatio").text(msg.baseModel.corpContributiveRatio);
				$("#corpBoardMember").text(msg.baseModel.corpBoardMember);
				$("#corpVoteRule").text(msg.baseModel.corpVoteRule);
				$("#restAnswerMail").text(msg.baseModel.restAnswerMail);
				// $("#restAnswerLink").text(msg.baseModel.restAnswerLink);
				$("#restProjectManagers").text(msg.baseModel.restProjectManagers);
				$("#restFollowerManagers").text(msg.baseModel.restFollowerManagers);
				// $("#riskDisclaimerDes").val(msg.baseModel.riskDisclaimerDes);
				// $("#schemeProtocol").val(msg.baseModel.schemeProtocol);
				if(msg.baseModel.schemeProtocol){
					var _temp = '<div style="color:red;">温馨提示：请在汇款后下载以上跟投协议，并填写个人信息部分，交至事业部/城市公司财务处核对，由人力统一盖章；或按《募集信息》要求执行。</div>';
 					$("#protocal_info").html(structSchemeLink(msg.baseModel.schemeProtocol)+_temp);
				}else{
					$("#protocal_info").html("");
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

function getSchemeInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../FollowSchemeController/getSchemeByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				schemeInfo = msg.baseModel;
				 // $("#schemeid").text(msg.baseModel.schemeId);
				 $("#subscribeStartInp").text((new Date(msg.baseModel.subscribeStartDate)).format('yyyy-MM-dd'));
				 $("#subscribeEndtInp").text((new Date(msg.baseModel.subscribeEndDate)).format('yyyy-MM-dd'));
				 $("#payStartInp").text((new Date(msg.baseModel.payStartDate)).format('yyyy-MM-dd'));
				 $("#payEndInp").text((new Date(msg.baseModel.payEndDate)).format('yyyy-MM-dd'));
				 $("#payReleaseDateInp").text((new Date(msg.baseModel.projectReleaseDate)).format('yyyy-MM-dd'));
				 // $("#personamt").text(msg.baseModel.personamt);
				 // $("#yxpersonamt").text(msg.baseModel.yxpersonamt);
				 // $("#jtpersonamt").text(msg.baseModel.jtpersonamt);
				 $("#fundPeake").text((msg.baseModel.fundPeake)+" 亿元");
				 $("#followAmount").text(formatMillions(msg.baseModel.followAmount)+" 万元");
				 $("#followAmountDesc").val(msg.baseModel.followAmountDesc);
				 $("#groupForceRatio").text((msg.baseModel.groupForceRatio)+" %");
				 $("#groupForceAmount").text(formatMillions(msg.baseModel.groupForceAmount)+" 万元");
				 $("#compForceRatio").text((msg.baseModel.compForceRatio)+" %");
				 $("#compForceAmount").text(formatMillions(msg.baseModel.compForceAmount)+" 万元");
				 $("#compChoiceRatio").text((msg.baseModel.compChoiceRatio)+" %");
				 $("#compChoiceAmount").text(formatMillions(msg.baseModel.compChoiceAmount)+" 万元");
				 $("#leverageDes").text(msg.baseModel.leverageDes);
				 $("#subscribeRemind").text(msg.baseModel.subscribeRemind);
				 $("#followChemeLink").html(structSchemeLink(msg.baseModel.followChemeLink));
				 // $("#followChemeLink").html(msg.baseModel.followChemeLink?'<a href="files/数据表.doc">跟投方案下载链接</a>':"");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function structSchemeLink(_str){
	var _linkArr = [];
	var _htmlStr = "";
	if(_str && _str.length>0){
		_linkArr = _str.split(";");
		$.each(_linkArr, function(ind, val){
			_htmlStr += '<div><a href="files/'+val+'">'+(ind+1)+'、'+val+'</a></div>';
		});
	}
	return _htmlStr;
}

function getForceList(){
	$.ajax({
		type:'post',//可选get
		url:'../ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'forceType':"1"
		},
		success:function(msg){
			if(msg.success){
				$("#forceTbody").empty();
				if(msg.dataDto && msg.dataDto.length > 0){
					$.each(msg.dataDto, function(ind, val){
						var tempHtml = 
							'<tr><td height="30">'+(ind+1)+'</td>'+
								'<td>'+val.name+'</td>'+
								'<td>'+(val.company||"")+'</td>'+
								'<td>'+(val.department||"")+'</td>'+
								'<td>'+(val.duty||"")+'</td>'+
								'<td>'+formatMillions(val.downlimit)+'</td>'+
								'<td>'+formatMillions(val.toplimit)+'</td>'+
								// '<td>'+(val.remark||"")+'</td></tr>';
								'<td></td></tr>';
						 $("#forceTbody").append(tempHtml);
					});
				}
			
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function getNewsList(){
	$.ajax({
		type:'post',//可选get
		url:'../DynamicNewsController/getNewsListByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'title':"",
			'releaseBegin':"",
			'releaseEnd':""
		},
		success:function(msg){
			if(msg.success){
				newsInfo = msg.dataDto;
			}else{
				alert(msg.error);
			}
			loadNewsList();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
		}
	});
}

function loadNewsList(){
	$("#newsTbody").empty();
	if(newsInfo && newsInfo.length > 0){
		var tempHtml = "";
		$.each(newsInfo, function(ind, val){
			tempHtml +=
			'<tr><td height="30">'+(ind+1)+'</td>'+
				'<td><a href="newsDetail.jsp?projectId='+projectId+'&newsId='+val.newsId+'">'+val.title+'</a></td>'+
				'<td>'+(new Date(val.releaseDate)).format('yyyy-MM-dd')+'</td>'+
				'<td>'+val.authorName+'</td></tr>';
		});
		$("#newsTbody").html(tempHtml);
	}
}