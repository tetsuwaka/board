<?php

// Smartyを取り込む
include_once("../lib/Smarty/Smarty.class.php");

// Databaseへのアクセス
require('../lib/dbaccess.php');

// Smartyインスタンスの生成
$smarty = new Smarty;

// threadidを得る
if (isset($_GET['thread'])){
    $threadid = $_GET['thread'];
}else{
    header('Location: index.php');
}

// DBからスレッドデータを取得
$db = db_connect();
$sql = "select * from bbs2 where id = :id";
$params = array(":id" => $threadid);
$stmt = $db->prepare($sql); $stmt->execute($params);
$thread = $stmt->fetch(PDO::FETCH_ASSOC);

// DBからエンティティデータの取得
$sql = "select * from entity where thread = :id order by id desc";
$stmt = $db->prepare($sql); $stmt->execute($params);
$entlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
$bbslist = array($thread, $entlist);

// threadデータとentityデータをアサイン
$smarty->assign("thread", $bbslist);

// テンプレートに渡す
$smarty->display("thread.tpl");

?>