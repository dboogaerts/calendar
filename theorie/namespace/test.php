<?php
namespace toto{
    function foo(){
        echo "foo de Toto";
    }
    
    $pdo = new \PDO();
}
namespace {
    require_once './lesfonctionsdemilie.php';
    require_once './namespace.1.php';

    // Un fichier qui inclut les deux fichiers de fonctions
    // pas de namespace  = \

    lesFonctionsdEmilie\foo();
    mesFonctions\foo();

    //foo(); // ERREUR PAS DE \foo()

    echo $bar."<br/>";
    toto\foo();

}

