<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
   <body> 
       <h1>Test sur le EventAdapter</h1>
<?php
require_once '../M/Adapter/EventAdapter.php';
require_once '../M/Utils/PDOConnexion.php';



echo "<h2>1 . Récupération d'un Calendar sans event</h2>
    <pre>
    ";
$ea = new M\Adapter\EventAdapter(M\Utils\PDOConnexion::getInstance());
var_dump($ea->getCalendar());
echo "</pre>";


//var_dump($ea->getCalendarByMonth(new DateTime("2016-06-10")));

$c = $ea->getCalendarByMonth(new DateTime("2016-05-10"));

echo "<h2>2 . Liste des events de Mai</h2>";

foreach ($c->getEvents() as $key => $value) {
    echo "<br/>".$key." : ".$value->getLibelle()."(".$value->getDateFrom()->format("d/m/Y")." au ".$value->getDateTo()->format("d/m/Y").")";
    
}
echo "<hr/>";
$c = $ea->getCalendarByMonth();

echo "<h2>3 . Liste des events du mois courant</h2>";

foreach ($c->getEvents() as $key => $value) {
    echo "<br/>".$key." : ".$value->getLibelle()."(".$value->getDateFrom()->format("d/m/Y")." au ".$value->getDateTo()->format("d/m/Y").")";
    
}
echo "<hr/>";
echo "<hr/>";
$c = $ea->getCalendarByMonth();

echo "<h2>3 . Liste des events du mois courant</h2>";

foreach ($c->getEvents() as $key => $value) {
    echo "<br/>".$key." : ".$value->getLibelle()."(".$value->getDateFrom()->format("d/m/Y")." au ".$value->getDateTo()->format("d/m/Y").")";
    
}
echo "<hr/>";
?>


    </body>
</html>