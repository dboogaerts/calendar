<?php
namespace C;
require_once __DIR__.'/../M/Utils/SessionManager.php';
require_once __DIR__.'/../M/Factories/AbstractUserAdapterFactory.php';

use M\Utils\SessionManager;
use M\Factories\AbstractUserAdapterFactory;
class UserController {
    /**
     *
     * @var M\Utils\SessionManager
     */
    private static $sm;
    
    public function __construct() {
        self::$sm = new SessionManager();
    }
    /**
     * 
     * @return M\Metier\User
     */
    public static function getCurrentUser(){
        
        $user=self::$sm->getValeur("user");
        
        return $user;
    }
    /**
     * 
     * @param string $login
     * @param string $mdp
     */
    public function login($login,$mdp) {
        $retour=false;
        $u = self::getCurrentUser("user");
        if($u!=null){
            $this->logout();
        }
        $adapter = AbstractUserAdapterFactory::getFactory(2)->getAdapter();
        $u = $adapter->getUser($login,$mdp);
        if($u!==false){
            self::$sm->setValeur("user",$u);
            $retour = true;
        }
        return $retour;   
    }
    
    public function logout() {
        self::$sm->setValeur("user",null);
    }
    public function permit($action) {
        $u  = self::getCurrentUser();
        $retour = false;
        switch ($action) {
            case "lire":
                if($u!=null)$retour=true;

                break;
            case "ecrire":
            case "modifier":
            case "supprimer":
                if($u!=null&&($u->getRole()=="proprietaire"||$u->getRole()=="collaborateur"))$retour=true;
                break;
            
            default:
                break;
        }
        return $retour;
    }
}
