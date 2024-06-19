<?php
// index.php

$request_uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('?', $request_uri);
$request_path = $uri_parts[0];

$routes = [
    '/proiect/api/actors' => ['controller' => 'ActorController', 'action' => 'getAllActors'],
    '/proiect/api/actors/search' => ['controller' => 'ActorController', 'action' => 'getActorByName'],
    '/proiect/api/index.php/api/movies' => ['controller' => 'MovieController', 'action' => 'getAllMovies'],
    '/proiect/api/names' => ['controller' => 'ActorController', 'action' => 'getAllActorsNames'],

    // alte rute
];
if (array_key_exists($request_path, $routes)) {
    require_once "Controllers/{$routes[$request_path]['controller']}.php";
    $controller_class = $routes[$request_path]['controller'];
    $controller = new $controller_class();
    $action_method = $routes[$request_path]['action'];
    echo $controller->$action_method();
} else {
    http_response_code(404);
    echo "Pagina nu a fost găsită.";
}
