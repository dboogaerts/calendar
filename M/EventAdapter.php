<?php
namespace M;

require_once __DIR__.'/Events.php';
require_once __DIR__.'/MyPDO.php';

use M\Events;
use M\MyPDO;

class EventAdapter {
    private $liste=[];
    private $pdo;
    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }
    /**
     * 
     * @param int $an
     * @param int $mois
     */
    public function getEventsByMonth($an,$mois){
        $datedeb = new DateTime($an."-".$mois."-01");
        $datefin = new DateTime($an."-".$mois."-01");
        $datefin->add(new DateInterval("P1M"))->sub(new DateInterval("P1D"));
        
        
        $sql = "select id, date_from, date_to, libelle, calendar_fk as calendar 
                from events 
                WHERE (
                    (date_from BETWEEN :datedeb AND :datefin) 
                    OR
                    (date_to BETWEEN  :datedeb AND :datefin)
                    OR
                    (:datedeb BETWEEN date_from AND date_to)
                    OR      
                    (:datefin BETWEEN date_from AND date_to)      
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["datedeb"=>$datedeb->format("Y-m-d"),"datefin"=>$datefin->format("Y-m-d")]);
         $stmt->setFetchMode(PDO::FETCH_CLASS,"Events");
         return $stmt->fetchAll();
        
    }
    function getCalendar() {
        $sql="SELECT * from calendar";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
    public function getEventsByDay($an,$mois,$jour){
        $datedeb = new DateTime($an."-".$mois."-".$jour);
        
        $sql = "select id, date_from, date_to, libelle, calendar_fk as calendar 
                from events 
                WHERE (
                    (:datedeb BETWEEN date_from AND date_to)
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["datedeb"=>$datedeb->format("Y-m-d")]);
         $stmt->setFetchMode(\PDO::FETCH_CLASS,"Events");
         return $stmt->fetchAll();
        
    }
    public function insertEvents(Events $e) {
        $sql="insert into events(date_from,date_to,libelle,calendar_fk) 
                Values (:datedeb,:datefin,:libelle,:calendar_fk)";
        $stmt = $this->pdo->prepare($sql);
        $retour = $stmt->execute(["datedeb"=>$e->getDate_from()->format("Y-m-d H:i:s"),
            "datefin"=>$e->getDate_to()->format("Y-m-d H:i:s"),
            "libelle"=>$e->getLibelle(),
            "calendar_fk"=>$e->getCalendar()
            ]);
        return $retour;
    }
    public function updateEvents(Events $e) {
        $sql="UPDATE events
                SET date_from = :datedeb,
                date_to = :datefin,
                libelle = :libelle,
                calendar_fk = :calendar_fk 
                WHERE id =:id
            ";
        $stmt = $this->pdo->prepare($sql);
        $retour = $stmt->execute(["datedeb"=>$e->getDate_from()->format("Y-m-d H:i:s"),
            "datefin"=>$e->getDate_to()->format("Y-m-d H:i:s"),
            "libelle"=>$e->getLibelle(),
            "calendar_fk"=>$e->getCalendar(),
            "id" => $e->getId()
            ]);
        return $retour;
    }
    public function deleteEvents($id) {
        $sql="DELETE FROM events
                WHERE id =:id
            ";
        $stmt = $this->pdo->prepare($sql);
        $retour = $stmt->execute([
                                    "id" => $id
                                ]);
        return $retour;
    }
    
}
//require_once './MyPDO.php';
//$e = new EventAdapter(M\MyPDO::getInstance());
//$r = $e->getEventsByMonth("2016", "06");
//echo json_encode($r);