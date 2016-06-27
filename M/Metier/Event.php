<?php
namespace M\Metier;


class Event {
    private $id;
    private $libelle;
    private $dateFrom;
    private $dateTo;
    private $proprietaire;
    private $calendar;
    /**
     * 
     * @return int
     */
    function getId() {
        return $this->id;
    }
    /**
     * 
     * @return string
     */
    function getLibelle() {
        return $this->libelle;
    }
    /**
     * 
     * @return \DateTime
     */
    function getDateFrom() {
        return $this->dateFrom;
    }
    /**
     * 
     * @return DateTime
     */
    function getDateTo() {
        return $this->dateTo;
    }
    
    /**
     * 
     * @return User
     */
    function getProprietaire() {
        return $this->proprietaire;
    }
    
    /**
     * 
     * @return Calendar
     */
    function getCalendar() {
        return $this->calendar;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setDateFrom($dateFrom) {
        $this->dateFrom = $dateFrom;
    }

    function setDateTo($dateTo) {
        $this->dateTo = $dateTo;
    }

    function setProprietaire($proprietaire) {
        $this->proprietaire = $proprietaire;
    }

    function setCalendar($calendar) {
        $this->calendar = $calendar;
    }

    
    public function popule($param) {
        $this->id = isset($param["id"])?$param["id"]:0;
        $this->calendar= isset($param["calendar"])?$param["calendar"]:null;
        $this->dateFrom= isset($param["dateFrom"])?$param["dateFrom"]:null;
        $this->dateTo= isset($param["dateTo"])?$param["dateTo"]:null;
        $this->libelle= isset($param["libelle"])?$param["libelle"]:null;
        $this->proprietaire= isset($param["proprietaire"])?$param["proprietaire"]:null;
    }
}
