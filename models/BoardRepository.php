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
    
    public function getThreadForDelivery() {
        $sql = "select id, title from bbs order by date desc";
        return $this->fetchAll($sql);
    }
    
    public function getEntity($id) {
        $sql = "select * from entity where thread = :id order by id desc limit 5";
        return $this->fetchAll($sql, array(':id' => $id));
    }
    
    public function getAllEntity($id) {
        $sql = "select * from entity where thread = :id order by date desc";
        return $this->fetchAll($sql, array(':id' => $id));
    }
    
    public function getThreadId($title) {
        $sql = "select id from bbs where title = :title";
        return $this->fetch($sql, array(':title' => $title));
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
        return $this->fetchNUM($sql, array(':thread' => $thread));
    }
    
    public function updateThread($thread, $length) {
        $sql = "update bbs set length = :length where id = :id";
        $this->execute($sql, array(':id' => $thread, ':length' => $length));
    }
    
    public function deleteThread($thread) {
        $sql = "delete from bbs where id = :id";
        $this->execute($sql, array(":id" => $thread));
    }
    
    public function deleteEntities($entityList) {
        $tempList = array();
        foreach ($entityList as $entity) {
            $tempList[] = "'{$entity}'";
        }
        $ids = implode(",", $tempList);
        $sql = "delete from entity where id in (" . $ids . ")";
        $this->execute($sql);
        return $ids;
    }
    
    public function makeThread($title) {
        $sql = "INSERT INTO bbs (title, length) values (:title, 1)";
        $this->execute($sql, array(':title' => $title));
    }

}