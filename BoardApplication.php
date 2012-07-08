<?php

class BoardApplication extends Application {
    
    protected $login_action = array('account', 'signin');
    
    public function getRootDir() {
        return dirname(__FILE__);
    }
    
    protected function registerRoutes() {
        return array(
            '/' => array('controller' => 'index', 'action' => 'index'),
            '/thread' => array('controller' => 'index', 'action' => 'thread')
        );
    }
    
    protected function configure() {
        $this->db_manager->connect('master', array(
            'dsn'      => 'mysql:dbname=board;host=127.0.0.1',
            'user'     => 'user',
            'password' => 'pass',
        ));
    }
}