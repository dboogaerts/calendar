<?php
namespace M\Metier;
class Calendar {
    private $id;
    private $nom;
    private $type;
    private $proprietaire;
    private $events;
    /**
     * Retourne l'id du calendrier
     * @return int
     */
    function getId() {
        return $this->id;
    }
    /**
     * Retourne le nom du calendrier
     * @return string
     */
    function getNom() {
        return $this->nom;
    }
    /**
     * retourne le type du calendrier
     * @return string
     */
    function getType() {
        return $this->type;
    }
    /**
     * retourne le User du propriétaire
     * @return User
     */
    function getProprietaire() {
        return $this->proprietaire;
    }
    /**
     * retourne un tableau de Event selon le type de remplissage choisi
     * @return Event[]
     */
    function getEvents() {
        return $this->events;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setProprietaire($proprietaire) {
        $this->proprietaire = $proprietaire;
    }

    function setEvents($events) {
        $this->events = $events;
    }
    function addEvent(Event $e){
        $this->events[$e->getId()]=$e;
    }

    public function popule($params) {
        $this->id = isset($params["id"])?$params["id"]:0;
        $this->events = isset($params["events"])?$params["events"]:[];
        $this->type = isset($params["type"])?$params["type"]:0;
        $this->proprietaire = isset($params["proprietaire"])?$params["proprietaire"]:0;
        $this->nom = isset($params["nom"])?$params["nom"]:0;
    }

}
