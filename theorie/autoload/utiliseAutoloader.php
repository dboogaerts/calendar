<?php
require_once './autoloader.php';
define("ROOT_PATH", __DIR__."/");

$al = new autoloader();
$al2 = new autoloader(__DIR__."/../vrac/");
use M\Utils\Bar;
$f = new Foo();
$b = new Bar();


$v = new Vrac();//dans ../vrac/Vrac.php