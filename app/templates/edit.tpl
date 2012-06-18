<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja-JP">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
<title>適当な掲示板</title>
</head>

<body>
<div id="head" align=center>
<h1>たぶん掲示板</h1>
</div>

<div id="message" align=center>
{if isset($message)}
  <p><font color="#FF0000">{$message|escape}</font></p>
{/if}
</div>
    
<div id="main" align=center>
<form method="POST" action="edit.php">
  <input type="hidden" name="ticket" value="{$ticket}"><br>
  
  <p id="type">どちらを削除しますか？<br>
    <input type="radio" name="type" value="thread" id="radio_thread"> スレッド
    <input type="radio" name="type" value="entity" id ="radio_entity"> エンティティ
  </p>
  
  <span id="selector"></span>
  <br><br>
  <span id="entitylist"></span>
  
  <br><br>
  <input name="erase" type="submit" id="erase" value="削除">
</form>
</div>

<br><br>
<div align="center"><a href="index.php">ホームに戻る</a></div>

</body>
<script src="../js/edit.js" type="text/javascript" charset="UTF-8"></script>
</html>
