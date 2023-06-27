<?php
    require_once '../vendor/autoload.php';

    $router = new \Bramus\Router\Router();

    $routes = glob(__DIR__ . '/../scripts/routes/*.php');

    foreach ($routes as $route) {
        $fileName = basename($route, '.php');
        $className = "\App\\" . $fileName;
        $className::getInstance()->configureRoutes($router);
    }

    $router->run();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

?>
<!-- \\\ -->
<!-- // \App\staff::getInstance(json_decode(file_get_contents("php://input"), true))->deleteStaff("13"); -->
