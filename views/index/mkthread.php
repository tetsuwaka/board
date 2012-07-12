<div id="input" align=center>
<form method="POST" action="<?php echo $base_url; ?>/create">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>">
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
<div align="center"><a href="/board/index.php">ホームに戻る</a></div>