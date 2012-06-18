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

<div id="boardlist" align="center">
    <table border="2" width="500px">
    <tr><td>
    {foreach from=$threadlist item=thread}
        <a href="thread.php?thread={$thread.id}">{$thread.title|escape}({$thread.length})</a>
    {/foreach}
    </td></tr>
    </table>
</div>
    
<div id="board" align=center>
  {foreach from=$bbslist item=thread}
  <div class="thread">
  <span class="thread_title"><h2>{$thread.0.title|escape}</h2></span>
  
  {foreach from=$thread.1 item=bbs}
  <div class="entity">
  <table border="1" width=500px>
  <tr><td>
  <span class="name_date"><b>{$bbs.name|escape} : {$bbs.date|escape}</b></span><br>
  <span class="body"><p>{$bbs.body|escape|nl2br}</p></span>
  </td></tr>
  </table>
  </div>
  {/foreach}
   
   <br>
   <div class="gothread" align="right">
       <a href="thread.php?thread={$thread.0.id}">このスレッドを全部見る</a>
   </div>
  
  <div class="box" align="center">
  <br>
  <button class="write">このスレッドに書き込みを行う</button>
  <br>
  
  <div class="area">
    <form method="POST" action="write.php">
    <input type="hidden" name="thread" value="{$bbs.thread|escape}">
    <div align=left>名前：<br></div>
    <div align=center><input type="text" name="name" size="44"></div>
    <div align=left>本文：<br></div>
    <div align=center><textarea name="body" cols=40 rows=4></textarea></div>
    <input type="submit" value="書き込み">
    <input type="reset" value="取消">
    </form>
  </div>
  
  </div>
  
  
  </div>
  {/foreach}
</div>
 
<br><br>
<div id="input" align=center>
    <a href="mkthread.php"><h3>スレッドを作成する</h3></a>
</div>

<br>

<div id="login" align=center>
<form method="POST" action="login.php">
    ID：<input type="text" name="id" size="10">
    パスワード：<input name="pass" type="password" value="" id="pass" size="10">
    <input name="login" type="submit" id="login" value="管理者ログイン">
</form>
</div>

</body>
<script src="../js/index.js" type="text/javascript" charset="UTF-8"></script>
</html>
