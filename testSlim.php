<?php
require_once './vendor/Slim-3.x/vendor/autoload.php';


$app = new \Slim\App();


$app->get("/get", function ($requete,$response,$args){
    $response->write("Hello");
    
});
$app->get("/", function ($requete,$response,$args){
    $response->write("Hello");
    
});
$app->run();
