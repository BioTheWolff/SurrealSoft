<?php

// Interfaces
require_once 'IGeneral.php';
require_once 'ICRUD.php';

// Controllers
require_once 'MainController.php';
require_once 'ErrorController.php';
require_once 'AccountController.php';

if (
    class_exists($class = (ucfirst($_GET['controller'] ?? 'main') . "Controller")) &&
    method_exists($class, $action = $_GET['action'] ?? 'readAll') &&
    $class != 'ErrorController' && // forbid reading errors
    $action != 'get_controller_name' // forbid reading the controller name
)
{
    $class::$action();
}
else
{
    ErrorController::http_404();
}