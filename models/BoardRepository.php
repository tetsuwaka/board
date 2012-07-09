<?php

class BoardRepository extends DbRepository {

    public function getThread() {
        $sql = "select * from bbs order by date desc";
        return $this->fetchAll($sql);
    }
    
    public function getThreadById($threadid) {
        $sql = "select * from bbs where id = :id";
        return $this->fetch($sql, array(':id' => $threadid));
    }
    
    public function getEntity($id) {
        $sql = "select * from entity where thread = :id order by id desc limit 5";
        return $this->fetchAll($sql, array(':id' => $id,));
    }
    
    public function insertEntity($body, $thread, $name = "") {
        $params = array (":body" => $body, ":thread" => $thread);
        if (!isset($name) or $name === "") {
            $sql = "INSERT INTO entity (body, thread) values (:body, :thread)";
            $this->execute($sql, $params);
        } else {
            $sql = "INSERT INTO entity (name, body, thread) values (:name, :body, :thread)";
            $params[":name"] = $name;
            $this->execute($sql, $params);
        }
    }
    
    public function getEntityCount($thread) {
        $sql = "select count(*) from entity where thread = :thread";
        return $this->fetch($sql, array(':thread' => $thread));
    }
    
    public function updateThread($thread, $length) {
        $sql = "update bbs set length = :length where id = :id";
        $this->execute($sql, array(':id' => $thread, ':length' => $length));
    }

}