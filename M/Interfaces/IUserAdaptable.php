<?php
namespace M\Interfaces;
interface IUserAdaptable {
    /**
     * @param string $login Login de l'utilisateur
     * @param string $mdp Mot de passe de l'utilisateur
     * @return User|false Renvoit l' utilisateur correspondant au login/mdp ou false
     */
    public function getUser($login,$mdp);
}
