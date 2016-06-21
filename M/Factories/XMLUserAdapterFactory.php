<?php

/**
 * Description of XMLUserAdapterFactory
 *
 * @author denis
 */
require_once __DIR__.'/./AbstractUserAdapterFactory.php';
require_once '../Adapter/UserXMLAdapter.php';
class XMLUserAdapterFactory extends AbstractUserAdapterFactory{
    private $xmlAdapter=null;
    public function getAdapter() {
        if($this->xmlAdapter == null){
            $this->xmlAdapter = new UserXMLAdapter(__DIR__."/../../ressources/users.xml");
        }
        return $this->xmlAdapter;
    }
}
