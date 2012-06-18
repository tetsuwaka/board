<?php


# PDOを利用したDBへのアクセス
function db_connect () {

  //$pass = '09023';
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}


# 管理者アクセス
function Authenticator($id , $pass) {

  $db = db_connect();
  $sql = "SELECT id, pass from member where id = :id";
  $params[':id'] = $id;
  $stmt = $db->prepare($sql);
  $stmt->execute($params);
  $member= $stmt->fetch();
  if ($id == $member['id'] && sha1($pass) == $member['pass']) {
    return true;
  }
  return false;
}

?>


