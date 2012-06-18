// グローバル変数であるスレッドリストとエンティティリスト
var threadlist;
var entitylist;

// sessionStorageの初期化
$(document).ready(function(){
  sessionStorage.clear();
});

// スレッドリストと初期エンティティリストをGET
$.getJSON("getThreadlist.php", null, 
function(data){
  threadlist = data;
  $.getJSON("getEntitylist.php", {'id': threadlist[0].id}, 
    function(data){
      entitylist = data;
  });
});

// スレッドリストを表示
function showThreadlist(){
  list = new Array();
  list.push("<select name=\"thread\" onchange=\"saveThread();\">")
  for (var i = 0; i < threadlist.length; i++){
    if (sessionStorage['thread'] == threadlist[i].id){
      list.push("<option value=" + threadlist[i].id + " selected>" + threadlist[i].title + "</option>");
    }else{
      list.push("<option value=" + threadlist[i].id + ">" + threadlist[i].title + "</option>");
    }
  }
  list.push("</select>");
  return list.join("\n");
}

// スレッドリストを表示(エンティティリストのための)
function showThreadlistForEntity(){
  list = new Array();
  list.push("<select name=\"threadforentity\" id=\"selectThread\" onchange=\"getNewEntitylist();\">")
  for (var i = 0; i < threadlist.length; i++){
    if(sessionStorage['entity'] == threadlist[i].id){
      list.push("<option value=" + threadlist[i].id + " id=" + threadlist[i].id + " selected>" + threadlist[i].title + "</option>");
    }else{
      list.push("<option value=" + threadlist[i].id + " id=" + threadlist[i].id + ">" + threadlist[i].title + "</option>");
    }
    
  }
  list.push("</select>");
  return list.join("\n");
}

// エンティティリストの表示
function showEntitylist(){
  list = new Array();
  list.push("<table border=1 width=\"500px\">");
  for (var i = 0; i < entitylist.length; i++){
    list.push("<tr><th>" + entitylist[i].id + "</th><td>" + entitylist[i].name + "</td><td>" + entitylist[i].body + "</td><td><input type=\"checkbox\" name=\"entity[]\" value=\"" + entitylist[i].id + "\"></td></tr>");
  }
  list.push("</table>");
  return list.join("\n");
}


// ラジオボタンが押されたときの動作
$('#type').change(function(){
  
  // スレッドが選択されば場合の処理
  if(document.getElementById('radio_thread').checked){
    $('#selector').html(showThreadlist()); 
    $('#entitylist').html(""); 
    
  // エンティティが選択された場合の処理
  }else if(document.getElementById('radio_entity').checked) {
    $('#selector').html(showThreadlistForEntity());
    $('#entitylist').html(showEntitylist());
  }
});


// スレッドが選ばれた場合、そのスレッドのデータを取得
function getNewEntitylist(){
  var id = $('#selector option:selected').attr("id");
  $.ajaxSetup({async: false});
  $.getJSON("getEntitylist.php", {'id': id}, function(data){entitylist = data;});
  $.ajaxSetup({async: true});
  $('#entitylist').html(showEntitylist());
  sessionStorage['entity'] = $('#selector option:selected').val();
}

// スレッドが選択された場合の処理
function saveThread(){
  var a = $('#selector option:selected').val();
  sessionStorage['thread'] = a;
}