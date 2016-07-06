<?php
namespace M;
class Events implements \JsonSerializable{
    private $id;
    private $libelle;
    private $date_from;
    private $date_to;
    private $calendar;
    public function jsonSerialize() {
        return [
            "id"=>  $this->id,
            "libelle"=>  $this->libelle,
            "date_from"=>  $this->date_from,
            "date_to"=>  $this->date_to,
            "calendar_id"=>  $this->calendar       
        ];
        }

    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getDate_from() {
        return $this->date_from;
    }

    function getDate_to() {
        return $this->date_to;
    }

    function getCalendar() {
        return $this->calendar;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setDate_from($date_from) {
        $this->date_from = $date_from;
    }

    function setDate_to($date_to) {
        $this->date_to = $date_to;
    }

    function setCalendar($calendar) {
        $this->calendar = $calendar;
    }

    public function popule($param) {
        $this->id=(isset($param->id))?$param->id:0;
        $this->date_from=(isset($param->date_from))?new Date($param->date_from):null;
        $this->date_to=(isset($param->date_to))?new Date($param->date_to):null;
        $this->libelle=(isset($param->libelle))?$param->libelle:"";
        $this->calendar=(isset($param->calendar))?$param->calendar:"";
        
    }
    
}
