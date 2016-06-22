<?php
namespace M\Metiers;

require_once __DIR__.'/./Carmello.php';
require_once __DIR__.'/../Filles/Ebru.php';

use M\Filles\Ebru;
use \PDO;

class Cedric {
    private $balls;
    private $copain;
    private $copine;
    private $pdo;
    public function __construct($c) {
        $this->copain = $c;
        $this->copine = new Ebru();
        $this->pdo = new PDO();
    }
    
    function getBalls() {
        return $this->balls;
    }

    function setBalls($balls) {
        $this->balls = $balls;
    }
    
    function faisMangerTonCopain() {
        $this->copain->mangeDesPates();
        $this->copine->chocolat();
    }

}
