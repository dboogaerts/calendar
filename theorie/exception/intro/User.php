<?php
require_once './RequisException.php';
class User {
    private $nom;
    function getNom() {
        return $this->nom;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    public function valide() {
         if(!isset($this->nom)||$this->nom==""){
             throw new RequisException("le nom n'est pas rempli");
         }
    }
}
