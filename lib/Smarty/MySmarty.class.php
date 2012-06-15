<?php
// 基本ディレクトリを定義する
//define("ROOT_DIR", "C:\\xampp\\htdocs\\board");

// Smartyクラスを読み込む
require_once("Smarty.class.php");

// Smartyクラスを継承してMySmartyクラスを新たに作る
class MySmarty extends Smarty {
  //function MySmarty() {
  function __construct() {
    parent::__construct();
    $this->smarty = new Smarty();
    $this->template_dir = "../../templates";
    $this->compile_dir = "../../templates_c";
    //$this->Smarty();
    //$this->left_delimiter = "{{";
    //$this->right_delimiter = "}}";
    //$this->plugins_dir = array("plugins", "myplugins");
  }
}
