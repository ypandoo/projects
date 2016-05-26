$(document).ready(function(){

var username;
var password;




$("#btn_login").click(function(){
	
	var drops = new Array();  
    var dict = { "subscribeConfigrmRecordId":"123",
    	"payTimes":"12",
    	"payAmount":"12",
    	"payDate":"2014-09-01 09:50:00"}
    	
    drops.push(dict);
	username = $("#uname").val();
	password = $("#pass").val();

		if(username.length==0 || password.length==0){
			bootbox.alert("<strong style='text-align:center; color:maroon;'>Enter username or password</strong>");

		}else{
				
			$.ajax({
				url: window.location.origin+"/Login/login",
				type: "post",
				data: "username="+username+"&password="+password,
				success: function(data){
					bootbox.alert(data);

				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					bootbox.alert(XMLHttpRequest.responseText);
		        }

			});

		}
})


})

