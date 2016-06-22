<?php
namespace M\Adapter;

require_once __DIR__.'/../Interfaces/IUserAdaptable.php';
require_once (__DIR__.'/../Utils/PDOConnexion.php');
require_once __DIR__.'/../Metier/User.php';

use \PDO;
use M\Interfaces\IUserAdaptable;

class UserDBAdapter implements IUserAdaptable{
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo=$pdo;
    }
    /**
     * retourne un utilisateur ayant le même login/mdp ou false
     * @param string $login
     * @param string $mdp
     * @return User|false
     */
    public function getUser($login, $mdp) {
        $sql = "select users.id as id, users.nom as nom, users.login as login, users.email as email, users.ip as ip, roles.nom as role"
                . " FROM users "
                . " JOIN roles ON users.fk_role = roles.id"
                . " WHERE login = :login AND pwd = MD5(:mdp)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS,"\M\Metier\User");
        $stmt->execute(["login"=>$login, "mdp"=>$mdp]);
        return $stmt->fetch();
                
    }

}
