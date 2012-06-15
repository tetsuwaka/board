<?php


# PDOを利用したDBへのアクセス
function db_connect () {
  $dsn = 'mysql:dbname=board;host=localhost';
  $user = 'root';
  //$pass = 'tessan';
  $pass = '09023';
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

?>


