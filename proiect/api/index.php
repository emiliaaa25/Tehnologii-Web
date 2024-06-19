<?php
// index.php

$request_uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('?', $request_uri);
$request_path = $uri_parts[0];

$routes = [
    '/proiect/api/actors' => ['controller' => 'ActorController', 'action' => 'getAllActors'],
    '/proiect/api/actors/search' => ['controller' => 'ActorController', 'action' => 'getActorByName', 'params' => ['name']],
    '/proiect/api/movies' => ['controller' => 'MovieController', 'action' => 'getAllMovies'],
    '/proiect/api/names' => ['controller' => 'ActorController', 'action' => 'getAllActorsNames'],
    '/proiect/api/years' => ['controller' => 'YearController', 'action' => 'getAllYears'],
    '/proiect/api/specificYear' => ['controller' => 'YearController', 'action' => 'getAllFromSpecificYear', 'params' => ['year']],


    // alte rute
];
if (array_key_exists($request_path, $routes)) {
    require_once "Controllers/{$routes[$request_path]['controller']}.php";
    $controller_class = $routes[$request_path]['controller'];
    $controller = new $controller_class();
    $action_method = $routes[$request_path]['action'];

    // Extrage parametrii din query string, dacă există
    $params = [];
    if (isset($routes[$request_path]['params'])) {
        foreach ($routes[$request_path]['params'] as $param) {
            if (isset($_GET[$param])) {
                $params[$param] = $_GET[$param];
            } else {
                $params[$param] = null;
            }
        }
    }
    echo $controller->$action_method($params);
} else {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Pagina nu a fost găsită.']);
}
