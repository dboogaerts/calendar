<?php
require_once '../../../M/Utils/PDOConnexion.php';
class Foo {
    public function methodesoulevantuneerreur() {
        echo "dans ma fonction\n";
        $e = new Exception("Erreur débile", 123, NULL);
        throw $e;
        echo "Fin de fonction\n";
    
    }
    public function fonctionsoulevantunepdoexception() {
        $c = M\Utils\PDOConnexion::getInstance();
        $stmt = $c->prepare("select * from user");
        try{
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getCode();
            if($ex->getCode()=="42S02"){
                echo "erreur trop grave...";
                throw @new PDOException("Table inexistante","42S02",$ex);
            }
        }
    }
}
