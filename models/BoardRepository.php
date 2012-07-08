<?php

class BoardRepository extends DbRepository {

    public function getThread() {
        $sql = "select * from bbs order by date desc";
        return $this->fetchAll($sql);
    }
    
    public function getEntity($id) {
        $sql = "select * from entity where thread = :id order by id desc limit 5";
        return $this->fetchAll($sql, array(':id' => $id,));
    }

}