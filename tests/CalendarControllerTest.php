<?php
header("content-type:text/plain;charset=utf-8");
require_once '../C/CalendarController.php';
use C\CalendarController;
/*
 * Tester si le Calendar Controller fait bien son job   
 */

$cc = new CalendarController();


echo "Test du calendarController";
echo "\n";
echo "--------------------------";
echo "\n";


echo "Test getCalendarTout simple";
echo "\n";
echo "--------------------------";
echo "\n";
$calendar = $cc->getCalendar();
var_dump($calendar);
echo "Type utilisateur : ".get_class($calendar->getProprietaire());
echo "\n";
echo "Valeur de type : ".$calendar->getType();
echo "\n";


echo "Test getCalendar pour les Events du mois courant";
echo "\n";
echo "--------------------------";
echo "\n";
$calendar = $cc->getCalendar(CalendarController::MONTH);
var_dump($calendar);
$evt = $calendar->getEvents();
echo "Type Events : ".get_class($calendar->getEvents());
echo "\n";
echo "nb Events : ".count($evt);
echo "\n";
$i=1;
foreach ($evt as $key => $value) {
    echo "\n";
    echo "Event ".$i++." : ".$value->getLibelle()." - ".$value->getDateFrom()->format("d/m/Y")." au ".$value->getDateFrom()->format("d/m/Y");

}

