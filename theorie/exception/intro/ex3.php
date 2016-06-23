<?php
require_once './User.php';

$u = new User();

try{
    
    $u->valide();
    //Ajout dans la db
}catch (RequisException $re) {
     echo "Erreur de type champ requis : ".$re->getMessage();
     $u->setNom("Doe");
     //ajout dans la db
}catch (ValidationException $ve) {
    echo "Erreur de type validation inconnue : ".$ve->getMessage();
}catch (Exception $e) {
    echo "Erreur inconnue : ".$e->getMessage();
}