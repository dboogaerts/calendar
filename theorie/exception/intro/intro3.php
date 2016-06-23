<?php
header("Content-type:text/plain;charset=utf-8");
require_once '../../../M/Utils/PDOConnexion.php';
$c = M\Utils\PDOConnexion::getInstance();
//
//$stmt = $c->prepare("select * from users");
//$stmt->execute();
//var_dump($stmt->fetchAll());
//echo "--------------------------\n";
//$stmt = $c->prepare("select * from user");
//$stmt->execute();
//var_dump($stmt->fetchAll());

echo "--------------------------\n";
$stmt = $c->prepare("select * from user");

try{
    $stmt->execute();
    echo "try : Tu me vois?\n";
    var_dump($stmt->fetchAll());
}catch(PDOException $e){
    echo "catch : Tu me vois?\n";
    echo $e->getMessage();
    
}  finally {
    echo "finnaly";
}
echo "après\n";