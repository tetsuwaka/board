<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja-JP">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<link rel="stylesheet" href="../css/index.css" type="text/css">
<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
<title>適当な掲示板</title>
</head>

<body>
<div id="head" align=center>
<h1>たぶん掲示板</h1>
</div>

<div id="input" align=center>
<form method="POST" action="create.php">
    <input type="hidden" name="ticket" value="{$ticket}">
    <div align=left>スレッド名 : <br></div>
    <div align=center><input type="text" name="title" size="60"></div>
    <div align=left>名前：<br></div>
    <div align=center><input type="text" name="name" size="60"></div>
    <div align=left>本文：<br></div>
    <div align=center><textarea name="body" cols=54 rows=6></textarea></div>
    <input type="submit" value="作成">
    <input type="reset" value="取消">
</form>
</div>

<br><br>
<div align="center"><a href="index.php">ホームに戻る</a></div>
</body>
</html>
