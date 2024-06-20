<?php

require_once '../app/init.php';
$routes = [
    '/proiect/api/actors' => ['controller' => 'ActorController', 'action' => 'getAllActors'],
    '/proiect/api/actors/search' => ['controller' => 'ActorController', 'action' => 'getActorByName', 'params' => ['name']],
    '/proiect/api/movies' => ['controller' => 'MovieController', 'action' => 'getAllMovies'],
    '/proiect/api/names' => ['controller' => 'ActorController', 'action' => 'getAllActorsNames'],
    '/proiect/api/years' => ['controller' => 'YearController', 'action' => 'getAllYears'],
    '/proiect/api/specificYear' => ['controller' => 'YearController', 'action' => 'getAllFromSpecificYear', 'params' => ['year']],
    '/proiect/api/actors/letter' => ['controller' => 'ActorController', 'action' => 'getActorsStartingWith', 'params' => ['letter']],


    // alte rute
];


$app = new App;
?>