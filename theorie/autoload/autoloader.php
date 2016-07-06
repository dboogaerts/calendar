<?php
class autoloader {
    private $racine;
    public function __construct($r = ROOT_PATH) {
        $this->racine = $r;
        spl_autoload_register(array($this,"load"));
    }
    public function load($param) {
     
        $path = $this->racine.str_replace("\\","/",$param).".php";
   
        if(is_file($path)){
            require_once $path;
        }
    }
}
