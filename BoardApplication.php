<?php

class BoardApplication extends Application {
    
    protected $login_action = array('account', 'signin');
    
    public function getRootDir() {
        return dirname(__FILE__);
    }
    
    protected function registerRoutes() {
        return array(
            '/' => array('controller' => 'status', 'action' => 'index')
        );
    }
    
    protected function configure() {
        $this->db_manager->connect('master', array(
            'dsn'      => 'mysql:dbname=board;host=localhost',
            'user'     => 'user',
            'password' => 'pass',
        ));
    }
}