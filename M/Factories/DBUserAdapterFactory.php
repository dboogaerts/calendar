<?php
namespace M\Factories;

require_once __DIR__.'/./AbstractUserAdapterFactory.php';
require_once __DIR__.'/../Adapter/UserDBAdapter.php';
require_once __DIR__.'/../Utils/PDOConnexion.php';

use M\Adapter\UserDBAdapter;
use M\Factories\AbstractUserAdapterFactory;
use M\Utils\PDOConnexion;

class DBUserAdapterFactory extends AbstractUserAdapterFactory{
    private $DBAdapter=null;
    public function getAdapter() {
        if($this->DBAdapter == null){
            $this->DBAdapter = new UserDBAdapter(PDOConnexion::getInstance());
        }
        return $this->DBAdapter;
    }
}

