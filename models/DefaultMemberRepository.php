<?php

class DefaultMemberRepository extends DbRepository {

    public function makeDefaultUser($userid, $pass) {
        $sql = "INSERT INTO member VALUES (:userid, :pass)";
        return $this->execute($sql, array(':userid' => $userid, 'pass' => sha1($pass)));
    }
}
