<?php
namespace M\Adapter;

require_once __DIR__.'/../Interfaces/IUserAdaptable.php';
require_once __DIR__.'/../Utils/PDOConnexion.php';
require_once __DIR__.'/../Metier/User.php';
use DOMDocument;
use M\Interfaces\IUserAdaptable;
use M\Metier\User;

class UserXMLAdapter implements IUserAdaptable{
    private $doc;
    public function __construct($file) {
        $this->doc=new DOMDocument("1.0", "utf8");
        $this->doc->load($file);
    }
    public function getUser($login, $mdp) {
        /**
         * @var DOMNodeList Liste des users
         */
        $users = $this->doc->getElementsByTagName("user");
        $retour = false;
        $i=0;
        while ($i<$users->length && !$retour){
            $l = $users->item($i)->getElementsByTagName("login")->item(0)->textContent;
            $m = $users->item($i)->getElementsByTagName("mdp")->item(0)->textContent;
            
            if($login == $l && $mdp==$m){
                $retour = new User();
                $retour ->popule([
                    "id" => $users->item($i)->getElementsByTagName("id")->item(0)->textContent,
                    "role" => $users->item($i)->getElementsByTagName("role")->item(0)->textContent,
                    "nom" => $users->item($i)->getElementsByTagName("nom")->item(0)->textContent,
                    "email" => $users->item($i)->getElementsByTagName("email")->item(0)->textContent,
                    "ip" => $users->item($i)->getElementsByTagName("ip")->item(0)->textContent,
                    "login" => $l,
                ]);
            }
            $i++;
        }
        return $retour;
    }

}
