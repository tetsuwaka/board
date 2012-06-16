<?php
  // Databaseへのアクセス
  require('../lib/dbaccess.php');
  
  // POSTのデータを受けてとる
  $name = $_POST['name'];
  $body = $_POST['body'];
  $thread = $_POST['thread'];
  
  // SQL文生成
  $db = db_connect();
  $params = array (":body" => $body, ":thread" => $thread);
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
  
  // スレッドのDATEをアップデート
  $sql = "select count(*) from entity where thread = :thread";
  $params = array(":thread" => $thread);
  $stmt = $db->prepare($sql); $stmt->execute($params);
  $result = $stmt->fetch(PDO::FETCH_NUM);
  
  $params = array (":id" => $thread, ":length" => $result[0]);
  $sql = "update bbs2 set length = :length where id = :id";
  $stmt = $db->prepare($sql);
  $db->beginTransaction();
  try {
    $stmt->execute($params);
    $db->commit();
  }catch(PDOException $e){
    echo "error";
    var_dump($result);
    $db->rollBack();
  }
  
?>

<script type="text/javascript" charset="UTF-8">
  alert("書き込みました。");
  function exec(){
    location.href = "index.php";
  }
  var timer;
  timer = setTimeout("exec()",1000); 
</script>