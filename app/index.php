<?php

define("MAXTHREAD", 5); //表示スレッド数

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
$threadlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

// DBからエンティティデータの取得
$count = 0;
$bbslist = array();
foreach ($threadlist as $thread){
  $sql = "select * from entity where thread = :id order by id desc limit 5";
  $params = array(":id" => $thread['id']);
  $stmt = $db->prepare($sql); $stmt->execute($params);
  $entlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $bbslist[] = array($thread, $entlist);
  // 読み込み数になったら終わり
  ++$count; if ($count == MAXTHREAD){break;}
}

// threadデータとentityデータをアサイン
$smarty->assign("threadlist", $threadlist);
$smarty->assign("bbslist", $bbslist);

// テンプレートに渡す
$smarty->display("index.tpl");

?>