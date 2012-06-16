<?php

// Databaseへのアクセス
require('../lib/dbaccess.php');

//セッションスタート
session_start();
session_regenerate_id();


if (!isset($_POST['title'], $_POST['body'], $_POST['ticket'])){
    header('Location: index.php');
}

if ($_POST['ticket'] != $_SESSION['ticket']){
    header('Location: index.php');
}

$name = $_POST['name'];
$body = $_POST['body'];

// SQL文生成
$db = db_connect();
$params = array (":title" => $_POST['title']);
$sql = "INSERT INTO bbs2 (title, length) values (:title, 1)";

// SQL文実行
$stmt = $db->prepare($sql);
$db->beginTransaction();
try {
  $stmt->execute($params);
  $db->commit();
}catch(PDOException $e){
  $db->rollBack();
}

// スレッドのIDを得る
$sql = "select id from bbs2 where title = :title";
$stmt = $db->prepare($sql); $stmt->execute($params);
$myid = $stmt->fetch(PDO::FETCH_ASSOC);


// SQL文生成
$db = db_connect();
$params = array (":body" => $body, ":thread" => $myid['id']);
if (!isset($name) or $name == ""){
  $sql = "INSERT INTO entity (body, thread) values (:body, :thread)"; 
}else{
  $sql = "INSERT INTO entity (name, body, thread) values (:name, :body, :thread)";
  $params[":name"] = $name;
}

// SQL文実行
$stmt = $db->prepare($sql);
$db->beginTransaction();
try {
  $stmt->execute($params);
  $db->commit();
}catch(PDOException $e){
  $db->rollBack();
}

?>


<html lang="ja-JP">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" charset="UTF-8">
  alert("書き込みました。");
  function exec(){
    location.href = "index.php";
  }
  var timer;
  timer = setTimeout("exec()",1000); 
</script>
</head>
<body></body>
</html>