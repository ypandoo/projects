$(document).ready(function(){

var username;
var password;




$("#btn_login").click(function(){
	

	username = $("#uname").val();
	password = $("#pass").val();

		if(username.length==0 || password.length==0){
			bootbox.alert("<strong style='text-align:center; color:maroon;'>Enter username or password</strong>");

		}else{
				
			$.ajax({
				url: window.location.origin+"/"+password,
				type: "post",
				data:{
<<<<<<< HEAD
					'FNAME':'testApp',
					'FSTATE':'FSTATE',
					'uid':6012
=======
					
					"FPROJECTID":3
					
>>>>>>> 18d80fbf61c73b9589f8b9b63b4729d9da5281e6
				
				},
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

