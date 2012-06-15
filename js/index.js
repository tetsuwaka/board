// 書き込みボタンを押したときの動作
$('.write').click(function () {
  $(this).siblings('.area').toggle("fast");
});

$(document).ready(function (){
  $('.area').hide();
});