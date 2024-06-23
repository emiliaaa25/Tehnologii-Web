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
    '/proiect/api/actors/details' => ['controller' => 'ActorController', 'action' => 'getActorDetails', 'params' => ['name']],


    // alte rute
];


require_once '../app/controllers/UserController.php';
$controller = new UserController();

    
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'addUser':
            $input = json_decode(file_get_contents('php://input'), true);
            $firstname = $input['firstname'] ?? '';
            $lastname = $input['lastname'] ?? '';
            $username = $input['username'] ?? '';
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? '';

            $success = $controller->addUser($firstname, $lastname, $username, $email, $password);

            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            break;
        case 'addAward':
                $input = json_decode(file_get_contents('php://input'), true);
                $year = $input['year'] ?? '';
                $category = $input['category'] ?? '';
                $full_name = $input['full_name'] ?? '';
                $won = $input['won'] ?? '';
        
                $success = $controller->addAward($year, $category, $full_name, $won);
        
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                break;
        case 'getUsers':
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
            $users = $controller->getUsersPaginated($page, $pageSize);
            $totalUsers = $controller->getTotalUsers();
            header('Content-Type: application/json');
            echo json_encode(['users' => $users, 'total' => $totalUsers]);
            break;
        case 'getAwards':
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
            $awards = $controller->getScreenActorGuildAwardsPaginated($page, $pageSize);
            $totalAwards = $controller->getTotalAwards();
            header('Content-Type: application/json');
            echo json_encode(['awards' => $awards, 'total' => $totalAwards]);
            break;
        
    case 'register':
        $controller->register();
        break;
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'uploadCSV':
        $controller->uploadCSV();
        break;
    case 'deleteUser':
        $controller->deleteUser();
        break;
    case 'editUser':
        $controller->editUser();
        break;
    case 'deleteAward':
        $controller->deleteAward();
        break;
    default:
        $app = new App();
        include_once 'C:\xampp\htdocs\ProiectMVC\app\views\Login.php';
        break;
}
} else {
$app = new App();
include_once 'C:\xampp\htdocs\ProiectMVC\app\views\Login.php';
}
?>