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
        image.load(function() { $obj.doResize() });
      }
    },
    doResize: function(e) {
      var proportions = image.width() / image.height();
      var newheight = target.height();
      var newwidth = newheight * proportions;
      if (newwidth < target.width()) {
        newwidth = target.width();
        newheight = newwidth / proportions;
      }
      image.height(parseInt(newheight)).width(parseInt(newwidth));

      setTimeout($obj.doResize, 2000);
    }
  };

  $obj.init();
};

$(function(){
  $('#background-image').fullbg('#site-main-wrapper');
})