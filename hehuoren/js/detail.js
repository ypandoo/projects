(function(){
    var self = this;
    this.avalon_title_control = avalon.define("title-controller", function (vm) {
         vm.toggle_content=function(id){
            if ($('#'+id).is(':visible')) 
            {
                $('#em_'+id).css("background-image", "url(img/arrow_up.png)");  
                $('#'+id).toggle();
            }
            else
            {
                $('#em_'+id).css("background-image", "url(img/arrow_down.png)");  
                $('#'+id).toggle();
            }
            
              
        };
    });
}).call(define('title-space'));