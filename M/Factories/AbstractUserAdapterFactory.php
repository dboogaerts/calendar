<?php
/**
 * Description of AbstractUserAdapterFactory
 *
 * @author denis
 */
require_once __DIR__.'/XMLUserAdapterFactory.php';
abstract class AbstractUserAdapterFactory {
     const XML=1;
     const DB = 2;
     public static function getFactory($i){
         switch ($i) {
             case self::XML:
                 return new XMLUserAdapterFactory();
                 break;
             case self::DB:
                 return;
                 break;

             default:
                 break;
         }
    }
    abstract public function getAdapter();
}

var_dump(AbstractUserAdapterFactory::getFactory(1)->getAdapter()->getUser("Dragon Rouge","titi"));
