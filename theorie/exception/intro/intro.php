<?php
header("Content-type:text/pplain;charset=utf-8");
require_once '../../../M/Utils/PDOConnexion.php';
$c = M\Utils\PDOConnexion::getInstance();

$stmt = $c->prepare("select * from users");
var_dump($stmt->fetchAll());

