$.fn.handle_images = function()
{
  var $h = this;
  var $f = $('form', $h);
  var $obj;

  $obj = {
    init: function() {
      $f.fileupload();
    }
  };

  $obj.init();

  return this;
};

$(function() {
  $('#images-holder').handle_images();
});