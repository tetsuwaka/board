<?php

# ワンタイムトークンパス用のチケット発行
function mkticket(){
    return sha1(uniqid() . mt_rand());
}

?>
