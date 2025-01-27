<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/PostController.php';

$controller = $_GET['controller'] ?? 'post';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'user':
        $controllerInstance = new UserController();
        break;
    case 'post':
        $controllerInstance = new PostController();
        break;
    default:
        die("Controller niet gevonden.");
}

if (!method_exists($controllerInstance, $action)) {
    die("Actie niet gevonden.");
}

$controllerInstance->$action();
