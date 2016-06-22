<?php
namespace M\Factories;

require_once __DIR__.'/XMLUserAdapterFactory.php';
require_once __DIR__.'/DBUserAdapterFactory.php';
abstract class AbstractUserAdapterFactory {
     const XML=1;
     const DB = 2;
     public static function getFactory($i){
         switch ($i) {
             case self::XML:
                 return new XMLUserAdapterFactory();
                 break;
             case self::DB:
                 return new DBUserAdapterFactory();
                 break;

             default:
                 break;
         }
    }
    abstract public function getAdapter();
}


