<?php
header("Content-type:text/plain;charset=utf8");
require_once '../C/UserController.php';

use C\UserController;

echo "Test sur le UserController\n";
echo "---------------------------\n";

echo "Test 1 : Utilisateur loggué par défaut";
$c = new UserController();
echo "\nCurrent User : ";
try{
    var_dump(UserController::getCurrentUser());
    echo "\n";
    echo "Lire : ".(($c->permit("lire"))?"OK":"KO");
    echo "\n";
    echo "Ecrire : ".(($c->permit("ecrire"))?"OK":"KO");
    echo "\n";
    echo "Modifier : ".(($c->permit("modifier"))?"OK":"KO");
    echo "\n";
    echo "Delete : ".(($c->permit("supprimer"))?"OK":"KO");
    echo "\n";
    echo "---------------------------\n";
}catch(M\Exceptions\UserNotFoundException $unfe){
    echo "Pas d'utilisateur loggué";
    echo "\n";
    echo "---------------------------\n";
}
echo "Test 2 : utilisateur non enregistré";
echo "\n";
echo "\n";

try{
    $log = $c->login("toto", "titi");
    echo  "echec : l'utilisateur est connecté\n";
}catch(M\Exceptions\UserNotFoundException $unfe){
    echo "mauvais login : "."OK";
    echo "\nCurrent User : ";
    try{
        var_dump(UserController::getCurrentUser());
        echo "\n";
        echo "Lire : ".(($c->permit("lire"))?"OK":"KO");
        echo "\n";
        echo "Ecrire : ".(($c->permit("ecrire"))?"OK":"KO");
        echo "\n";
        echo "Modifier : ".(($c->permit("modifier"))?"OK":"KO");
        echo "\n";
        echo "Delete : ".(($c->permit("supprimer"))?"OK":"KO");
        echo "\n";
    }catch(M\Exceptions\UserNotFoundException $unfe2){
        echo "pas d'utilisateur connecté.\n";
    }
}

try{
    echo "\n";
    echo "---------------------------\n";
    $log = $c->login("Dragon Rouge", "titi");
    echo "Test 3 : utilisateur propriétaire";
    echo "\n";
    echo "\n";
    echo "Bon login : ".(($log)?"OK":"KO");
    echo "\nCurrent User : ";
    var_dump(UserController::getCurrentUser());
    echo "\n";
    echo "\n";
    echo "Lire : ".(($c->permit("lire"))?"OK":"KO");
    echo "\n";
    echo "Ecrire : ".(($c->permit("ecrire"))?"OK":"KO");
    echo "\n";
    echo "Modifier : ".(($c->permit("modifier"))?"OK":"KO");
    echo "\n";
    echo "Delete : ".(($c->permit("supprimer"))?"OK":"KO");
    echo "\n";
}catch(M\Exceptions\UserNotFoundException $unfe){
    echo "Echec de la connexion : ".$unfe->getMessage();
}
echo "---------------------------\n";

echo "\n";
echo "---------------------------\n";
echo "Test 3 : utilisateur collaborateur";
echo "\n";
echo "\n";

try{
    $log = $c->login("carme", "toto");

    echo "Bon login : ".(($log)?"OK":"KO");
    echo "\nCurrent User : ";
    var_dump(UserController::getCurrentUser());
    echo "\n";
    echo "\n";
    echo "Lire : ".(($c->permit("lire"))?"OK":"KO");
    echo "\n";
    echo "Ecrire : ".(($c->permit("ecrire"))?"OK":"KO");
    echo "\n";
    echo "Modifier : ".(($c->permit("modifier"))?"OK":"KO");
    echo "\n";
    echo "Delete : ".(($c->permit("supprimer"))?"OK":"KO");
    echo "\n";
    echo "---------------------------\n";
}  catch (M\Exceptions\UserNotFoundException $unfe){
    echo "Echec de la connexion : ".$unfe->getMessage();
}
echo "\n";
echo "---------------------------\n";
echo "Test 4 : utilisateur lecteur";
echo "\n";
echo "\n";
try{
    $log = $c->login("emi", "lapin");
    echo "Bon login : ".(($log)?"OK":"KO");
    echo "\nCurrent User : ";
    var_dump(UserController::getCurrentUser());
    echo "\n";
    echo "\n";
    echo "Lire : ".(($c->permit("lire"))?"OK":"KO");
    echo "\n";
    echo "Ecrire : ".(($c->permit("ecrire"))?"OK":"KO");
    echo "\n";
    echo "Modifier : ".(($c->permit("modifier"))?"OK":"KO");
    echo "\n";
    echo "Delete : ".(($c->permit("supprimer"))?"OK":"KO");
    echo "\n";
    echo "---------------------------\n";
}  catch (M\Exceptions\UserNotFoundException $unfe){
    echo "Echec de la connexion : ".$unfe->getMessage();
}