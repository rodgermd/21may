$.fn.fullbg = function(target_selector) {
  var image = $(this);
  var target = $(target_selector);

  var $obj;

  $obj =  {
    init: function() {
      if (image.width()) {
        $obj.doResize();
      }
      else {
        image.load($obj.doResize);
      }
    },
    doResize: function() {
      image.height(target.height()).css('visibility', 'visible');
    }
  };

  $obj.init();


};

$(function(){
  $('#background-image').fullbg('#site-main-wrapper');
})