<?php

class CreatingTablesRepository extends DbRepository {

    public function createBbs() {
        $sql = "CREATE TABLE IF NOT EXISTS bbs (" .
                " id serial," .
                " title varchar(255)," .
                " date timestamp DEFAULT CURRENT_TIMESTAMP," .
                " length integer(11)" .
                ") default charset=utf8";
        $this->query($sql);
    }

    public function createEntity() {
        $sql = "CREATE TABLE IF NOT EXISTS entity (" .
                " id serial," .
                " thread integer NOT NULL," .
                " name varchar(255) NOT NULL DEFAULT 'nanashi'," .
                " body text," .
                " date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP" .
                ") DEFAULT CHARSET=utf8";
        $this->query($sql);
    }

    public function createMember() {
        $sql = "CREATE TABLE IF NOT EXISTS member (" .
                " id varchar(255) DEFAULT NULL," .
                " pass varchar(255) DEFAULT NULL" .
                " )  DEFAULT CHARSET=utf8";
        $this->query($sql);
    }

}