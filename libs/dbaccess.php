<?php


# PDOを利用したDBへのアクセス
function db_connect () {
  $dsn = 'mysql:dbname=bbs;host=localhost';
  $user = 'root';
  $pass = 'tessan';
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

?>


