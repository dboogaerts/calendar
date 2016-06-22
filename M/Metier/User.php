<?php
namespace M\Metier;
class User {
    /**
     *
     * @var int 
     */
    private $id;
    /**
     *
     * @var string
     */
    private $nom;
    /**
     *
     * @var string
     */
    private $login;
    /**
     *
     * @var string
     */
    private $ip;
    /**
     *
     * @var string
     */
    private $role;
    /**
     *
     * @var string
     */
    private $email;
    
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

         function getId() {
         return $this->id;
     }

     function getNom() {
         return $this->nom;
     }

     function getLogin() {
         return $this->login;
     }

     function getIp() {
         return $this->ip;
     }

     function getRole() {
         return $this->role;
     }

     function setId($id) {
         $this->id = $id;
     }

     function setNom($nom) {
         $this->nom = $nom;
     }

     function setLogin($login) {
         $this->login = $login;
     }

     function setIp($ip) {
         $this->ip = $ip;
     }

     function setRole($role) {
         $this->role = $role;
     }
     function popule($tab){
         $this->id = (isset($tab["id"]))?$tab["id"]:0;
         $this->nom= (isset($tab["nom"]))?$tab["nom"]:null;         
         $this->login= (isset($tab["login"]))?$tab["login"]:null;
         $this->ip= (isset($tab["ip"]))?$tab["ip"]:null;
         $this->role= (isset($tab["role"]))?$tab["role"]:null;
         $this->email= (isset($tab["email"]))?$tab["email"]:null;
     }

}
