function getReqParam(paras){ 
    var url = location.search; 
    var paraString = url.substring(url.indexOf("?")+1,url.length).split("&"); 
    var paraObj = {} 
    
    for (i=0; j=paraString[i]; i++){ 
    	paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = unescape(j.substring(j.indexOf("=")+1,j.length)); 
    } 
    var returnValue = paraObj[paras.toLowerCase()]; 
    if(typeof(returnValue)=="undefined"){ 
    	return ""; 
    }else{ 
    	return returnValue; 
    } 
}

function formatMillions(_n){
    if(_n && (typeof(_n) == "number" || parseInt(_n))){
        return _n/10000;
    }
    return 0;
}

function sessionTimeout(XMLHttpRequest, textStatus, errorThrown){
    var sessionStatus = XMLHttpRequest.getResponseHeader('sessionstatus');
    if(sessionStatus == 'timeout') {
        var yes = confirm('由于您长时间没有操作, session已过期, 请重新登录.');
        if(yes) {
            location.href = '../front/login.jsp';/*${pageContext.request.contextPath}/front/*/
        }
    }else if(sessionStatus == "timeoutForApp"){
        alert("数据拉取失败! 当前登录已经失效，请退出重新进入.");
    }
}

function clearNoNum(obj)
{
    //先把非数字的都替换掉，除了数字和.
    obj.value = obj.value.replace(/[^\d.]/g,"");
    //必须保证第一个为数字而不是.
    obj.value = obj.value.replace(/^\./g,"");
    //保证只有出现一个.而没有多个.
    obj.value = obj.value.replace(/\.{2,}/g,".");
    //保证.只出现一次，而不能出现两次以上
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}