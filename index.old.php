<?php
//var_dump($_SERVER);
$query = (isset($_GET["query"]))?$_GET["query"]:"";
$verbe = $_SERVER["REQUEST_METHOD"];

require_once __DIR__.'/M/MyPDO.php';
require_once __DIR__.'/M/EventAdapter.php';
use M\MyPDO;
use M\EventAdapter;


$ea = new EventAdapter(MyPDO::getInstance());

switch ($verbe) {
    case "GET":
        preg_match_all("|([a-z0-9]+)|", $query, $parts);
        $cible = (isset($parts[0])&&isset($parts[0][0]))?$parts[0][0]:null;
        $annee = (isset($parts[0])&&isset($parts[0][1]))?$parts[0][1]:null;
        $mois = (isset($parts[0])&&isset($parts[0][2]))?$parts[0][2]:null;
        $jour = (isset($parts[0])&&isset($parts[0][3]))?$parts[0][3]:null;
        if($cible=="events"){
            if($annee!==NULL && $mois!==null && $mois ==null){
                echo json_encode($ea->getEventsByMonth($annee, $mois));
            }elseif ($annee!==NULL && $mois!==null && $jour!==null) {
                echo json_encode($ea->getEventsByDay($annee, $mois,$jour));
            }else{
                echo json_encode($ea->getCalendar());
            }
        }else{
            echo json_encode($ea->getCalendar());
        }
        break;
    case "PUT":
            $events = json_decode(file_get_contents("php://input"));
            if(is_array($event)){
                foreach ($events as $event) {
                    $ev  = new Events();
                    $ev->popule($event);
                    $ea->insertEvents($ev);
                }
            }  else {
                $ev  = new Events();
                $ev->popule($events);
                $ea->insertEvents($ev);
            }
        break;
    case "POST":
          $events = json_decode(file_get_contents("php://input"));
            if(is_array($event)){
                foreach ($events as $event) {
                    $ev  = new Events();
                    $ev->popule($event);
                    $ea->updateEvents($ev);
                }
            }  else {
                $ev  = new Events();
                $ev->popule($events);
                $ea->updateEvents($ev);
            }
        break;
    case "DELETE":
        $cible = (isset($parts[0])&&isset($parts[0][0]))?$parts[0][0]:null;
        $id = (isset($parts[0])&&isset($parts[0][1]))?$parts[0][1]:null;
        $ea->deleteEvents($id);    
        break;
    default:
        
        break;
}
