<?php
namespace M\Factories;

require_once __DIR__.'/./AbstractUserAdapterFactory.php';
require_once __DIR__.'/../Adapter/UserXMLAdapter.php';
use M\Adapter\UserXMLAdapter;

class XMLUserAdapterFactory extends AbstractUserAdapterFactory{
    private $xmlAdapter=null;
    public function getAdapter() {
        if($this->xmlAdapter == null){
            $this->xmlAdapter = new UserXMLAdapter(__DIR__."/../../ressources/users.xml");
        }
        return $this->xmlAdapter;
    }
}
