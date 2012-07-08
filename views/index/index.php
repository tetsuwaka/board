<div id="boardlist" align="center">
    <table border="2" width="500px">
        <tr><td>
                <?php foreach ($threadList as $thread): ?>
                    <a href="thread.php?thread=<?php echo $thread['id']; ?>"><?php echo $this->escape($thread['title']); ?>(<?php echo count($thread); ?>)</a>
                <?php endforeach; ?>
            </td></tr>
    </table>
</div>

<div id="board" align=center>
    <?php foreach ($bbsList as $thread): ?>
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
            <div class="gothread" align="right">
                <a href="<?php echo $base_url; ?>/thread/?threadid=<?php echo $thread[0]['id']; ?>">このスレッドを全部見る</a>
            </div>

            <div class="box" align="center">
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
    <?php endforeach; ?>
</div>

<br><br>
<div id="input" align=center>
    <a href="mkthread.php"><h3>スレッドを作成する</h3></a>
</div>

<br>

<div id="login" align=center>
    <form method="POST" action="login.php">
        <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>">
        ID：<input type="text" name="id" size="10">
        パスワード：<input name="pass" type="password" value="" id="pass" size="10">
        <input name="login" type="submit" id="login" value="管理者ログイン">
    </form>
</div>
<script src="js/index.js" type="text/javascript" charset="UTF-8"></script>