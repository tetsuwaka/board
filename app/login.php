<?php

// Databaseへのアクセス
require('../lib/dbaccess.php');

//セッションスタート
session_start();
session_regenerate_id(true);

if (isset($_POST['login'])){
   // 認証を関数化(DBへ問い合わせをして認証を行う)
  if (Authenticator($_POST["id"] , $_POST["pass"])) {
        
    // 認証の鍵を保存しておく
    $_SESSION["id"] = $_POST["id"];
       
    // 認証に成功したので、blog_edit.phpへリダイレクトする
    header("Location: edit.php");
    exit;
  }
}

header("Location: index.php");



?>
