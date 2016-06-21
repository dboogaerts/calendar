<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBUserAdapter
 *
 * @author denis
 */
require_once __DIR__.'/./AbstractUserAdapterFactory.php';
require_once __DIR__.'/../Adapter/UserDBAdapter.php';
require_once __DIR__.'/../Utils/PDOConnexion.php';
class DBUserAdapterFactory extends AbstractUserAdapterFactory{
    private $DBAdapter=null;
    public function getAdapter() {
        if($this->DBAdapter == null){
            $this->DBAdapter = new UserDBAdapter(PDOConnexion::getInstance());
        }
        return $this->DBAdapter;
    }
}

