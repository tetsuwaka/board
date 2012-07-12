<?php

class BoardApplication extends Application {

    //protected $login_action = array('admin', 'autheniticate');

    public function getRootDir() {
        return dirname(__FILE__);
    }

    protected function registerRoutes() {
        return array(
            '/' => array('controller' => 'index', 'action' => 'index'),
            '/thread' => array('controller' => 'index', 'action' => 'thread'),
            '/write' => array('controller' => 'index', 'action' => 'write'),
            '/mkthread' => array('controller' => 'index', 'action' => 'mkthread'),
            '/create' => array('controller' => 'index', 'action' => 'create'),
            '/login' => array('controller' => 'admin', 'action' => 'autheniticate'),
            '/edit' => array('controller' => 'admin', 'action' => 'edit'),
            '/delivery/thread' => array('controller' => 'delivery', 'action' => 'thread'),
            '/delivery/entity' => array('controller' => 'delivery', 'action' => 'entity'),
        );
    }

    protected function configure() {
        $this->db_manager->connect('master', array(
            'dsn' => 'mysql:dbname=board;host=127.0.0.1',
            'user' => 'user',
            'password' => 'pass',
        ));
    }

}