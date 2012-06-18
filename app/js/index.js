// 書き込みボタンを押したときの動作
$('.write').click(function () {
  $(this).siblings('.area').toggle("fast");
});

// 書き込み部分を隠す
$(document).ready(function (){
  $('.area').hide();
});