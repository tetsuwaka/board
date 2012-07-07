<?php

class BoardRepository extends DbRepository {

    public function getThread() {
        $sql = "select * from bbs2 order by date desc";
        return $this->fetchAll($sql);
    }
    
    public function getEntity($id, $limitNum) {
        $sql = "select * from entity where thread = :id order by id desc limit :limitNum";
        return $this->fetchAll($sql, array(':id' => $id, ':limitNum' => $limitNum));
    }

}