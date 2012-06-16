<?php

// Smartyを取り込む
include_once("../lib/Smarty/Smarty.class.php");

// チケット
require("../lib/ticket.php");

// Smartyインスタンスの生成
$smarty = new Smarty;

//sessionスタート
session_start();
session_regenerate_id();

// ワンタイムトークン作成
$ticket = mkticket();
$_SESSION['ticket'] = $ticket;

// threadデータとentityデータをアサイン
$smarty->assign('ticket', $ticket);

// テンプレートに渡す
$smarty->display('mkthread.tpl');

?>
