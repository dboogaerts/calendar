<?php
require_once 'M/Metiers/Cedric.php';
require_once 'M/Metiers/Carmello.php';

use M\Metiers\Cedric;
use M\Metiers\Carmello as Carmelo;


$c= new Cedric(new Carmelo());
$c->setBalls("grosses");
echo $c->getBalls();
$c->faisMangerTonCopain();