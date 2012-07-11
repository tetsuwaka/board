<div id="message" align=center>
    <?php if ($message !== ""): ?>
        <p><font color="#FF0000"><?php echo $this->escape($message) ?></font></p>
    <?php endif; ?>
</div>
    
<div id="main" align=center>
<form method="POST" action="<?php echo $base_url; ?>/edit">
  <input type="hidden" name="_token" value="<?php echo $this->escape($_token) ?>"><br>
  
  <p id="type">どちらを削除しますか？<br>
    <input type="radio" name="type" value="thread" id="radio_thread"> スレッド
    <input type="radio" name="type" value="entity" id="radio_entity"> エンティティ
  </p>
  
  <span id="selector"></span>
  <br><br>
  <span id="entitylist"></span>
  
  <br><br>
  <input name="erase" type="submit" id="erase" value="削除">
</form>
</div>

<br><br>
<div align="center"><a href="/board/index.php">ホームに戻る</a></div>
<script src="/board/js/edit.js" type="text/javascript" charset="UTF-8"></script>