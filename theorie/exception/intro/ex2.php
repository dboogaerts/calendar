<?php
header("Content-type:text/plain;charset=utf-8");
require_once './Foo.php';

$f=new Foo();

try {
    $f->methodesoulevantuneerreur();
} catch (Exception $exc) {
    echo "\n";
    echo $exc->getTraceAsString();
    echo "\n";
    echo $exc->getCode();
    echo "\n";
    echo $exc->getMessage();
    echo "\n";
}

try{
$f->fonctionsoulevantunepdoexception();
}catch(PDOException $e){
    echo $e->getMessage();
    echo $e->getPrevious()->getMessage();
}