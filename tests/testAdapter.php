<?php
    header("Content-type:text/plain;charset=utf8");
    require_once '../M/Adapter/UserDBAdapter.php';
    require_once '../M/Utils/PDOConnexion.php';
    $udb= new UserDBAdapter(PDOConnexion::getInstance());
    $u  = $udb->getUser("dragon rouge", "titi");
    if($u !==FALSE){
        echo "1. UserDBAdapter : ça marche ";
        var_dump($u);
    }else{
        echo "Echec";
    }
    
    $u2 =$udb->getUser("dragon vert", "titi");
        echo "---------------------------\n"
    . "Test 2 : Mauvais login ou mdp\n";
    if($u2===FALSE){
        echo "OK\n";
    }else{
        echo "KO\n";
        var_dump($u2);
    }
    
    require_once '../M/Adapter/UserXMLAdapter.php';
    
    $uxa = new UserXMLAdapter(__DIR__."/../ressources/users.xml");
    
    echo "---------------------------\n"
    . "Test 3 :XML Bon login ou mdp\n";
    
    $u3= $uxa->getUser("Dragon Rouge", "titi");
    if($u3 !==FALSE){
        echo "OK";
        var_dump($u3);
    }else{
        echo "Echec";
    }