$(function(){
  if($.isFunction($.fn.colorbox))
  {
    $('.lightbox-image').colorbox({maxWidth : '90%', maxHeight: '90%', rel: 'content'});
  }
});