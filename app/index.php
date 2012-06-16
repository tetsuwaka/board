<?php

// Smartyを取り込む
include_once("../lib/Smarty/Smarty.class.php");

// Databaseへのアクセス
require('../lib/dbaccess.php');

// Smartyインスタンスの生成
$smarty = new Smarty;

// DBからスレッドデータを取得
$db = db_connect();
$sql = "select * from bbs2 order by date desc";
$stmt = $db->prepare($sql); $stmt->execute();
$boardlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bbslist = array();

// DBからエンティティデータの取得
foreach ($boardlist as $board){
  $sql = "select * from entity where thread = :id order by id desc";
  $params = array(":id" => $board['id']);
  $stmt = $db->prepare($sql); $stmt->execute($params);
  $entlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $bbslist[] = array($board, $entlist);
}

$smarty->assign("bbslist", $bbslist);

// テンプレートに渡す
$smarty->display("index.tpl");

?>