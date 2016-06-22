<?php
require_once './Foo.php';
require_once './Bar.php';

$f= new MesObjets\Foo();
$f->hello();
echo "<hr/>";
$b = new MesObjets\Bar();
$b->hello();

echo "<hr/>";

use MesObjets\Foo as Foo;

$f2 = new Foo();
$f2->hello();

echo "<hr/>";

require_once './Foo2.php';

$f3 = new SesObjets\Foo();
$f3->hello();

echo "<hr/>";

use SesObjets\Foo as Foo2;

$f4 = new Foo2();
$f4->hello();
