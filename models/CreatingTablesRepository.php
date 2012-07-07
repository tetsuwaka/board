<?php

class CreatingTablesRepository extends DbRepository {
    
    public function createBbs() {
        $sql = "CREATE TABLE bbs (id serial, title varchar(255),"
        . "date timestamp DEFAULT CURRENT_TIMESTAMP"
        . "length integer(11))";
        $this->query($sql);
    }
    
}