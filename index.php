<?php
require_once './vendor/Slim-3.x/vendor/autoload.php';
require_once './autoloader.php';
define("ROOT_PATH", __DIR__."/");
use \C\CalendarController;
$al = new autoloader();
$app = new \Slim\App();
$cont = new CalendarController();
$app->post("/user/login",function ($requete,$response,$args){
    $uc= new C\UserController();
    $parsedBody = (object)$requete->getParsedBody();
    $uc->login($parsedBody->login,$parsedBody->mdp);
    return $response->withJSON(["status"=>"ok"]);
});
$app->delete("/user/login",function ($requete,$response,$args) use ($cont){
    $uc= new C\UserController();
    $uc->logout();
    return $response->withJSON(["status"=>"ok"]);
});
$app->get("/day/{annee}/{mois}/{jour}", function ($requete,$response,$args) use ($cont){
    //route pour récupérer les events de la journée
    $calendar = $cont->getCalendar(CalendarController::DAY, $args["annee"], $args["mois"], $args["jour"]);
    return $response->withJSON($calendar);
});
$app->get("/week/{annee}/{mois}/{jour}", function ($requete,$response,$args) use ($cont){
    //route pour récupérer les events de la semaine
    $calendar = $cont->getCalendar(CalendarController::WEEK, $args["annee"], $args["mois"], $args["jour"]);
    return $response->withJSON($calendar);
});
$app->get("/month/{annee}/{mois}/{jour}", function ($requete,$response,$args) use ($cont){
    //route pour récupérer les events de l'année
    $calendar = $cont->getCalendar(CalendarController::MONTH, $args["annee"], $args["mois"], $args["jour"]);
    return $response->withJSON($calendar);
});
$app->get("/", function ($requete,$response,$args) use ($cont){
    //retourne le calendrier
    $calendar = $cont->getCalendar();
    return $response->withJSON($calendar);
});
$app->delete("/event/{id}", function ($requete,$response,$args) use ($cont){
  
    $calendar = $cont->removeEvent($args["id"]);
    return $response->withJSON($calendar);
});
$app->put("/event/{id}", function ($requete,$response,$args) use ($cont){
    $parsedBody = (object)$requete->getParsedBody();
    $r= $cont->updateEvent($parsedBody);
    return $response->withJSON($r);
});
$app->post("/event/{id}", function ($requete,$response,$args) use ($cont){
    $parsedBody = (object)$requete->getParsedBody();
    $cont->addEvent($parsedBody);
    return $response;
});



$c = $app->getContainer();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c['response']->withStatus(200)
                      ->withHeader('Content-Type', 'application/json');
        try{
            throw $exception;
        } catch (\M\Exceptions\UserNotFoundException $ex) {
            $c['response']->withJSON(["status"=>"ko","message"=>$ex->getMessage(),"type"=>"securite"]);
        } catch (\M\Exceptions\UserAuthorizationException $ex2){
            $c['response']->withJSON(["status"=>"ko","message"=>$exception->getMessage(),"type"=>"securite"]);
        }catch(Exception $e){
            $c['response']->withJSON(["status"=>"ko","message"=>$exception->getMessage(),"type"=>"inconnu"]);
        }
        return $c['response'];
    };
};

$app->run();

/**
 * 
GET  /calendar     == rÈcupËre le calendrier vide
GET /calendar/month/an/mois/jour 
GET /calendar/week/an/mois/jour
GET /calendar/day/an/mois/jour

PUT /calendar/event 		
POST /calendar/event/id    	== modifier un Èchange
DELETE /calendar/event/id

 */