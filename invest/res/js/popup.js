var bookName;
var authorMail;

$("#logout").click(function(){
    bootbox.confirm("You sure you want to logout?",function(result){
        if(result==true){
         window.location = window.location.origin+"/index.php/home/logout";
        }
    });
    
    
});

$(document).on('click','.viewbook',function(){
  console.log('hey you clicked me!');
  var datasetHolder = this;

    view(datasetHolder);
});

$(document).on('click','.deletebook',function(){
    var datasetHolder = this;
    
    deletebook(datasetHolder);
});

$("#btn_savebook").click(function(){

		bookName = $("#txtBookname").val();
		authorMail = $("#txtEmail").val();

				if(bookName.length==0 || authorMail.length==0){
					bootbox.alert("Please complete the form!");

				}else{

					$.ajax({
						url: window.location.origin+"/index.php/ajax/savebook",
						type: "post",
						data: "bookname="+bookName+"&authormail="+authorMail,
						success: function(response){
							if(response==1){
							 
                                                                   window.location = window.location.origin+"/index.php";

							}else{
								bootbox.alert("Book was not added!");
							}
						}


					});
				}
				$("#txtBookname").val("");
				$("#txtEmail").val("");

});

function deletebook(datasets){
    $.ajax({
        url: window.location.origin+"/index.php/ajax/deletebook",
        type: 'GET',
        data: 'bookid='+datasets.dataset.id,
        success: function(response){
            
                if(response==1){
                    
                    window.location = window.location.origin;
                }
            
        }
    });
}
function view(datasets){

	box = bootbox.dialog({
		title: 'Viewing Book Info',
		message: "<center><img src='"+window.location.origin+"/index.php/res/img/loader.gif'></center>",
		size: 'large',
		onEscape: function(){
     
    }

	});

	$.ajax({

		url: window.location.origin+"/index.php/ajax/getbookbyId",
		type: 'GET',
		data: 'bookid='+datasets.dataset.id,
		success: function(response){
 		box.contents().find('.bootbox-body').html(response);
		}
	});
}
