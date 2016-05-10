(function(){
    //定义类
    this.define = this._define = function (s) {
        return (typeof  s != 'undefined' && typeof  this[s] == 'undefined') ? this[s] = {} : (this[s] || {});
    };
  }).call(this);

(function(){
  var self = this,
      $new_item=$('#new_item'),
      $item_list=$('#item_list'),
      $page_new_item = $('#page_new_item'),
      $page_item_list = $('#page_item_list');

  $new_item.click(function(){
      $page_item_list.hide();
      $page_new_item.fadeIn();
  });

  $item_list.click(function(){
      $page_new_item.hide();
      $page_item_list.fadeIn();
  });

}).call(define('item_list'));
