<?php

class MemberRepository extends DbRepository {  
    public function makeUser($userid, $pass) {
        $sql = "INSERT INTO member VALUES (:userid, :pass)";
        return $this->execute($sql, array(':userid' => $userid, 'pass' => sha1($pass)));
    }
    
    public function fetchByUserId ($userid) {
        $sql = "SELECT * from member where id = :userid";
        return $this->fetch($sql, array(':userid' => $userid));
    }
}
