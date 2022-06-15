$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
  $('[data-toggle="tooltip"]').on('show.bs.tooltip', function (e) {
   //Remove title tag from inside created svg tag
   $(this).find('title').remove();
 });
});
