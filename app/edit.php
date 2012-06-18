<?php

// Databaseへのアクセス
require('../lib/dbaccess.php');

// チケット
require("../lib/ticket.php");

// Smartyを取り込む
include_once("../lib/Smarty/Smarty.class.php");

// Smartyインスタンスの生成
$smarty = new Smarty;

//セッションスタート
session_start();
session_regenerate_id(true);

// セッションがおかしい
if (!isset($_SESSION['id'])){
  header("Location: index.php");
  exit;
}

// ワンタイムトークンパスがない場合
if ($_POST['ticket'] != $_SESSION['ticket']){
    header('Location: index.php');
    exit;
}


if(isset($_POST['erase'])){
  
  // スレッド削除
  if(isset($_POST['thread'])){
    $db = db_connect();
    $sql = "delete from bbs2 where id = :id";
    $params = array(":id" => $_POST['thread']);
    $stmt = $db->prepare($sql);
    $db->beginTransaction();
    try {
      $stmt->execute($params);
      $db->commit();
    } catch (PDOException $e) {
      $db->rollBack();
    }
    $message = "スレッド{$_POST['thread']}を削除しました。";
    
  // エンティティ削除
  }else if(isset($_POST['entity'])){
    $entitylist = explode(":", $_POST['entity']);
    $templist = array();
    foreach ($entitylist as $entity) {$templist[] = "'{$entity}'";}
    $ids = implode(",", $templist);
    
    $db = db_connect();
    $sql = "delete from entity where in (" . $ids . ")";
    $stmt = $db->prepare($sql);
    $db->beginTransaction();
    try {
      $stmt->execute($params);
      $db->commit();
    } catch (PDOException $e) {
      $db->rollBack();
    }
    $message = "エンティティ{$ids}を削除しました。";
  }
  
  // メッセージをアサイン
  $smarty->assign('message', $message);

}

// ワンタイムトークン作成
$ticket = mkticket();
$_SESSION['ticket'] = $ticket;

// チケットをアサイン
$smarty->assign('ticket', $ticket);

// テンプレートに渡す
$smarty->display('edit.tpl');

?>
