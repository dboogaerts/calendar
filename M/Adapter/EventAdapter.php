<?php

namespace M\Adapter;

require_once __DIR__ . '/../Metier/Calendar.php';
require_once __DIR__ . '/../Metier/Event.php';
require_once __DIR__ . '/../Metier/User.php';
require_once __DIR__.'/../Exceptions/CalendarNotFoundException.php';
require_once __DIR__.'/../Utils/DateTimeUtils.php';
use M\Metier\Calendar;
use M\Metier\Event;
use M\Metier\User;
use PDO;
use M\Utils\DateTimeUtils;
class EventAdapter {
    private $pdo;
    public function __construct(\PDO $pdo) {
        $this->pdo=$pdo;
    }
    
    private function creeCalendar($u) {
        $calendar = new Calendar();
        $user = new User();
        $user->popule([
            "id"    => $u->user_id,
            "nom"   => $u->user_nom,
            "login" => $u->user_login,
            "email" => $u->user_email,
            "ip"    => $u->user_ip,
            "role"  => $u->role,
            ]);
        
        $calendar->popule([
            "id"    =>$u->id,
            "type"  =>$u->type,
            "proprietaire"=>$user,
            "nom"   =>$u->nom,
        ]);
        return $calendar;
    }
    private function getEvents($where,$params,$calendar){
         $sql = "select 
                    events.id as id,
                    date_from as dateFrom, 
                    date_to as dateTo, 
                    libelle, 
                    calendar_fk as calendar ,
                    users.id as user_id,
                    users.nom as user_nom,
                    users.login as login, 
                    users.email as email, 
                    users.ip as ip, 
                    roles.nom as role
                from events 
                join users on fk_proprietaire = users.id
                JOIN roles ON users.fk_role = roles.id
                WHERE ($where)
                ORDER BY date_from ASC
                 ";
         
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        foreach ($stmt as $evt) {            
            $u = new User();
            $u->popule([
                "id"=>$evt->user_id,
                "nom"=>$evt->user_nom,
                "login"=>$evt->login,
                "email"=>$evt->email,
                "ip"=>$evt->ip,
                "role"=>$evt->role
                ]);
            $e = new Event();
            $e->popule((array)$evt);
            $e->setDateFrom(new \DateTime($e->getDateFrom()));
            $e->setDateTo(new \DateTime($e->getDateTo()));
            $e->setCalendar($calendar);
            $e->setProprietaire($u);
//            echo "---------------\n";
//            var_dump($e);
//            echo "---------------\n";
            $calendar->addEvent($e);
        }
    }
    /**
     * 
     * @return Calendar
     * @throws \M\Exceptions\CalendarNotFoundException
     */
    public function getCalendar() {
        $sql = "SELECT
                    `calendar`.`id` as id,
                    `calendar`.`nom` as nom,
                    `calendar`.`email`as email,
                    type.type as type,
                    `Users`.`id` as user_id,
                    `Users`.`nom` as user_nom,
                    `Users`.`login`as user_login,
                    `Users`.`email`as user_email,
                    `Users`.`ip` as user_ip,
                    `roles`.`nom` as role 
                    FROM `calendar`.`calendar`
                    JOIN type ON calendar.fk_type = type.id
                    JOIN users ON calendar.fk_proprietaire = users.id
                    JOIN roles ON users.fk_role = roles.id
                ; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $u = $stmt->fetch();
        
        if($u == null){
            throw new \M\Exceptions\CalendarNotFoundException("Pas de Calendrier correctement configuré");
        }
        $calendar = $this->creeCalendar($u);
        return $calendar;
                
    }
    /**
     * 
     * @param \DateTime $date
     * @return Calendar
     */
    public function getCalendarByMonth(\DateTime $date = null) {
        if($date == null){
            $date = new \DateTime();
        }
        $datedeb = DateTimeUtils::getFirstDateTimeOfMonth($date);
        $datefin = DateTimeUtils::getLastDateTimeOfMonth($date);
        $calendar = $this->getCalendar();
        $w = "date_from <= :datefin
                    AND
                    date_to >= :datedeb";
        
        $this->getEvents($w, ["datedeb"=>$datedeb->format("Y-m-d"),"datefin"=>$datefin->format("Y-m-d")],$calendar);
        
        return $calendar;
    }
    /**
     * 
     * @param \DateTime $date
     * @return 
     */
    public function getCalendarByWeek(\DateTime $date = null) {
        if($date == null){
            $date = new \DateTime();
        }
        $datedeb = DateTimeUtils::getFirstDateTimeOfWeek($date);
        $datefin = DateTimeUtils::getLastDateTimeOfWeek($date);
      
        $calendar = $this->getCalendar();
        
        $w = "date_from <= :datefin
                    AND
                    date_to >= :datedeb";
        $this->getEvents($w, ["datedeb"=>$datedeb->format("Y-m-d"),"datefin"=>$datefin->format("Y-m-d")],$calendar);
        return $calendar;
    }
    /**
     * 
     * @param \DateTime $date
     * @return Calendar
     */
    public function getCalendarByDay(\DateTime $date = null) {
        if($date == null){
            $date = new \DateTime();
        }
        $calendar = $this->getCalendar();
        
        $w = " date(date_from) <= :date AND date(date_to) >= :date";
        $this->getEvents($w, ["date"=>$date->format("Y-m-d")],$calendar);
        return $calendar;
    }

    public function addEvents(Calendar $c, Event $e) {
        $uid=uniqid();
        $sql="INSERT INTO `calendar`.`events`
                (`id`,
                `date_from`,
                `date_to`,
                `libelle`,
                `calendar_fk`,
                `fk_proprietaire`)
                VALUES
                (:uid, 
                :date_deb, 
                :date_fin, 
                :libelle,
                :calendar_id,
                :proprio_id)";
        $stmt = $this->pdo->prepare($sql);
        //var_dump($e);
        $stmt->execute([
                    "uid" => $uid,
                    "date_deb" =>$e->getDateFrom()->format("Y-m-d H:i:s"), 
                    "date_fin" =>$e->getDateTo()->format("Y-m-d H:i:s"), 
                    "libelle"  =>$e->getLibelle(),
                    "calendar_id"=>$e->getCalendar()->getId(),
                    "proprio_id" =>$e->getProprietaire()->getId()
                ]);
        return $uid;
    }

    public function removeEvent($id) {
        $sql="DELETE FROM events where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$id]);
    }

    public function updateEvent(Event $e) {
        $sql="
            UPDATE `calendar`.`events`
                SET
                
                `date_from` = :date_rom,
                `date_to` = :date_to,
                `libelle` = :libelle:,
                `calendar_fk` = :calendar_fk:,
                `fk_proprietaire` = :fk_proprietaire:
                WHERE id=:id;
            ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
                    "date_from" =>$e->getDateFrom()->format("Y-m-d H:i:s"), 
                    "date_to" =>$e->getDateTo()->format("Y-m-d H:i:s"), 
                    "libelle"  =>$e->getLibelle(),
                    "calendar_fk"=>$e->getCalendar()->getId(),
                    "fk_proprietaire" =>$e->getUser()->getId()
                ]);
    }

}
