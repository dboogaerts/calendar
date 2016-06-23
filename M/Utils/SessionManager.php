<?php
namespace M\Utils;

class SessionManager{
    public function __construct() {
        if(!isset($_SESSION)){
            session_start();
        }
    }
    /**
     * 
     * @param string le nom de la cle
     * @param mixed la valeur à stocker
     */
    function setValeur($cle,$valeur) {
        $_SESSION[$cle] = $valeur;
    }
    /**
     * 
     * @param string le nom sous lequel est stocké l'info
     */
    function getValeur($cle){
        return (isset($_SESSION[$cle]))?$_SESSION[$cle]:null;
    }
    
    function destroy(){
        session_destroy();
        unset($_SESSION);
        unset($this);
    }
}
