<?php

namespace C;

require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/../M/Adapter/EventAdapter.php';
require_once __DIR__ . '/../M/Exceptions/UserAuthorizationException.php';
require_once __DIR__ . '/../M/Exceptions/UserAuthorizationException.php';
require_once __DIR__ . '/../M/Exceptions/UserAuthorizationException.php';
require_once __DIR__ . '/../M/Metier/Calendar.php';
require_once __DIR__ . '/../M/Metier/User.php';
require_once __DIR__ . '/../M/Metier/Event.php';

use C\UserController;

class CalendarController {

    const VIDE = 0;
    const MONTH = 1;
    const WEEK = 2;
    const DAY = 3;

    private $pdo;
    private $user;
    private $adapter;

    public function __construct($param=null) {
        $this->pdo = \M\Utils\PDOConnexion::getInstance();
        $this->user = new UserController();
        $this->adapter = new \M\Adapter\EventAdapter($this->pdo);
    }
    /**
     * 
     * @param int $type
     * @param int $an
     * @param int $mois
     * @param int $jour
     * @return \M\Metier\Calendar
     * @throws Exception
     * @throws \M\Exceptions\UserAuthorizationException
     */
    public function getCalendar($type = self::VIDE, $an = null, $mois = null, $jour = null) {
        //TODO : Ajouter la vérification sur le type de calendrier ("shared" ou "public")

        $a = ($an == null) ? (new \DateTime())->format("Y") : $an;
        $m = ($mois == null) ? (new \DateTime())->format("m") : $mois;
        $j = ($jour == null) ? (new \DateTime())->format("d") : $jour;
        $date = new \DateTime($a . "-" . $m . "-" . $j);

        if ($this->user->permit("lire")) {
            switch ($type) {
                case self::VIDE:
                    $retour = $this->adapter->getCalendar();
                    break;
                case self::MONTH:
                    $retour = $this->adapter->getCalendarByMonth($date);
                    break;
                case self::WEEK:
                    $retour = $this->adapter->getCalendarByWeek($date);
                    break;
                case self::DAY:
                    $retour = $this->adapter->getCalendarByDay($date);
                    break;
                default:
                    throw new Exception("Le type d'accès($type) n'est pas admis sur les calendriers");
                    break;
            }
        } else {
            throw new \M\Exceptions\UserAuthorizationException("L'utilisateur n'a pas les droits de lecture");
        }
        return $retour;
    }
    /**
     * 
     * @param \stdClass $event
     * @return Event
     * @throws \M\Exceptions\UserAuthorizationException
     */
    public function addEvent(\stdClass $event) {
        if (!$this->user->permit("ecrire")) {
            throw new \M\Exceptions\UserAuthorizationException("L'utilisateur n'a pas les droits d'écriture");
        }
        $e = $this->transformeEnEvent($event);
        
        $id_event = $this->adapter->addEvents($c, $e);
        $e->setId($id_event);
        return $e;
    }
    /**
     * 
     * @param int $eventId
     * @throws \M\Exceptions\UserAuthorizationException
     */
    public function removeEvent($eventId) {
        if (!$this->user->permit("supprimer")) {
            throw new \M\Exceptions\UserAuthorizationException("L'utilisateur n'a pas les droits de suppression");
        }
        
        $this->adapter->removeEvent($eventId);
    }
    /**
     * 
     * @param \stdClass $event
     * @throws \M\Exceptions\UserAuthorizationException
     */
    public function updateEvent(\stdClass $event) {
        if (!$this->user->permit("modifier")) {
            throw new \M\Exceptions\UserAuthorizationException("L'utilisateur n'a pas les droits de modification");
        }
        $e = $this->transformeEnEvent($event);
        return $this->adapter->updateEvent($e);
    }
    /**
     * 
     * @param \stdClass $event
     * @return \M\Metier\Event
     */
    private function transformeEnEvent(\stdClass $event) {
        $evt = json_decode(json_encode($event),true);
        var_dump($evt);
        $e = new \M\Metier\Event();
        $e->popule($evt);
         var_dump($e);
        $e->setDateFrom(new \DateTime($e->getDateFrom()));
        $e->setDateTo(new \DateTime($e->getDateTo()));
        //user
        $u = new \M\Metier\User();
        $u->setId($evt["proprietaire"]);
        $e->setProprietaire($u);
        //calendar
        $c=new \M\Metier\Calendar();
        $c->setId($evt["calendar"]);
        $e->setCalendar($c);
       
        return $e;
    }

}
