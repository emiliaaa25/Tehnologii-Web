<?php

require_once '../app/init.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/YearController.php';

// Define routes
$routes = [
    '/proiect/home' => ['controller' => 'HomePage'],
    '/proiect/api/actors' => ['controller' => 'ActorController', 'action' => 'getAllActors'],
    '/proiect/api/actors/search' => ['controller' => 'ActorController', 'action' => 'getActorByName', 'params' => ['name']],
    '/proiect/api/movies' => ['controller' => 'MovieController', 'action' => 'getAllMovies'],
    '/proiect/api/names' => ['controller' => 'ActorController', 'action' => 'getAllActorsNames'],
    '/proiect/api/years' => ['controller' => 'YearController', 'action' => 'getAllYears'],
    '/proiect/api/specificYear' => ['controller' => 'YearController', 'action' => 'getAllFromSpecificYear', 'params' => ['year']],
    '/proiect/api/actors/letter' => ['controller' => 'ActorController', 'action' => 'getActorsStartingWith', 'params' => ['letter']],
    '/proiect/api/actors/details' => ['controller' => 'ActorController', 'action' => 'getActorDetails', 'params' => ['name']],
    // other routes
];

// Create controller instances
$userController = new UserController();
$yearController = new YearController();

function handleRequest($routes, $userController, $yearController) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $action = $_GET['action'] ?? null;

    if (isset($routes[$uri])) {
        $route = $routes[$uri];
        $controllerName = $route['controller'];
        $actionName = $route['action'];
        $params = $route['params'] ?? [];
        
        require_once "../app/controllers/{$controllerName}.php";
        $controller = new $controllerName();

        call_user_func_array([$controller, $actionName], array_map(function($param) {
            return $_GET[$param] ?? null;
        }, $params));
    } elseif ($action) {
        switch ($action) {
            case 'getGenderStatistics':
                handleGenderStatistics($yearController);
                break;
            case 'exportAwards':
                handleExportAwards($yearController);
                break;
            case 'statistics':
                handleStatistics();
                break;
            case 'addUser':
                handleAddUser($userController);
                break;
            case 'addAward':
                handleAddAward($userController);
                break;
            case 'getUsers':
                handleGetUsers($userController);
                break;
            case 'getAwards':
                handleGetAwards($userController);
                break;
            case 'getAwardsByYear':
                handleGetAwardsByYear($userController);
                break;
            case 'register':
                $userController->register();
                break;
            case 'login':
                $userController->login();
                break;
            case 'logout':
                $userController->logout();
                break;
            case 'uploadCSV':
                $userController->uploadCSV();
                break;
            case 'deleteUser':
                $userController->deleteUser();
                break;
            case 'editUser':
                $userController->editUser();
                break;
            case 'deleteAward':
                $userController->deleteAward();
                break;
            default:
                require_once '../app/init.php';
                require_once '../app/core/App.php';
                $app = App();
                showLoginPage();
                break;
        }
    } else {
        showLoginPage();
    }
}

function handleGenderStatistics($yearController) {
    echo json_encode($yearController->getGenderStatistics());
}

function handleExportAwards($yearController) {
    $yearController->exportScreenActorGuildAwardsToCSV();
}

function handleStatistics() {
    $year = isset($_GET['year']) ? $_GET['year'] : '';
    include '../app/views/Statistics.php';
}

function handleAddUser($controller) {
    $input = json_decode(file_get_contents('php://input'), true);
    $firstname = $input['firstname'] ?? '';
    $lastname = $input['lastname'] ?? '';
    $username = $input['username'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    $success = $controller->addUser($firstname, $lastname, $username, $email, $password);

    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
}

function handleAddAward($controller) {
    $input = json_decode(file_get_contents('php://input'), true);
    $year = $input['year'] ?? '';
    $category = $input['category'] ?? '';
    $full_name = $input['full_name'] ?? '';
    $won = $input['won'] ?? '';

    $success = $controller->addAward($year, $category, $full_name, $won);

    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
}

function handleGetUsers($controller) {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
    $users = $controller->getUsersPaginated($page, $pageSize);
    $totalUsers = $controller->getTotalUsers();
    header('Content-Type: application/json');
    echo json_encode(['users' => $users, 'total' => $totalUsers]);
}

function handleGetAwards($controller) {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
    $awards = $controller->getScreenActorGuildAwardsPaginated($page, $pageSize);
    $totalAwards = $controller->getTotalAwards();
    header('Content-Type: application/json');
    echo json_encode(['awards' => $awards, 'total' => $totalAwards]);
}

function handleGetAwardsByYear($controller) {
    $year = isset($_GET['year']) ? $_GET['year'] : 0;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
    $awards = $controller->getScreenActorGuildAwardsPaginatedByYear($year, $page, $pageSize);
    $totalAwards = $controller->getTotalAwardsByYear($year);
    header('Content-Type: application/json');
    echo json_encode(['awards' => $awards, 'total' => $totalAwards]);
}

function showLoginPage() {
    include_once 'C:\xampp\htdocs\ProiectMVC\app\views\Login.php';
}

// Handle the incoming request
handleRequest($routes, $userController, $yearController);

?>
