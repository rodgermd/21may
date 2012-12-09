$(function(){
  $('.enable-tabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  })
});