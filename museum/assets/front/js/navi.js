(function(){
    var self = this;

    this.framework =  avalon.define({
        $id:"navi_ctrl",
        navi_code:'',
        navi_html: '',
        navi_name:'',
        list: [],
        selected: '',

        get_pic_url_path: function(e){
            return 'url('+e+')';
        },
        direct_to_list_path: function(){
           window.location.href = base_url + 'pages/view/new_expo';
        }
    });

    //get data via ajax
    this.get_list = function(){
        var url = base_url+'Navi/get_items';
        base_remote_data.ajaxjson(
                          url, //url
                          function(data){
                            if(data.hasOwnProperty('success')){
                                  if(data.success == 1){
                                      self.framework.list = data.data;
                                      self.framework.navi_code = data.data[0].NAVI_CODE;
                                      self.framework.navi_html = data.data[0].NAVI_HTML;
                                      self.framework.navi_name = data.data[0].NAVI_NAME;

                                  }
                                  else{
                                      alert(data.message);
                                  }
                              }
                            else {
                              alert('返回值错误!');
                            }
                        },
                        '',
                        function()
                        {
                          alert('网络错误!');
                        });
    };

    this.get_list();

}).call(define('space_navi'));
