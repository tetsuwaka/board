<div id="board" align=center>
    <div class="thread">
        <span class="thread_title"><h2><?php echo $this->escape($thread[0]['title']); ?></h2></span>
        <?php foreach ($thread[1] as $bbs): ?>
        <div class="entity">
            <table border="1" width=500px>
                <tr><td>
                        <span class="name_date"><b><?php echo $this->escape($bbs['name']); ?> : <?php echo $this->escape($bbs['date']); ?></b></span><br>
                        <span class="body"><p><?php echo nl2br($this->escape($bbs['body'])); ?></p></span>
                    </td></tr>
            </table>
        </div>
        <?php endforeach; ?>

        <br>
        <div class="goindex" align="right">
            <a href="<?php echo $base_url; ?>">ホームに戻る</a>
        </div>

        <div class="box">
            <br>
            <button class="write">このスレッドに書き込みを行う</button>
            <br>

            <div class="area">
                <form method="POST" action="write.php">
                    <input type="hidden" name="thread" value="<?php echo $this->escape($bbs['thread']); ?>">
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
</div>
<script src="js/index.js" type="text/javascript" charset="UTF-8"></script>