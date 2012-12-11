$.fn.handle_images = function()
{
  var $h = this;
  var $f = $('form', $h);
  var $list = $('#images-list', $h);
  var $obj;

  $obj = {
    init: function() {
      $f.fileupload();
      $list.sortable({
        stop: function(e, ui) {
         var order = $list.sortable( "serialize", { attribute: "image_id" } );
          $.ajax({
            url: $list.attr('update'),
            type: 'post',
            data: order
          })
        }
      });
    }
  };

  $obj.init();

  return this;
};

$(function() {
  $('#images-holder').handle_images();
});