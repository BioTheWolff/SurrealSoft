<?php

// Interfaces
require_once 'AbstractController.php';
require_once 'AbstractCRUDController.php';

// Controllers
Loader::loadImplementedControllers();


// check if no database error
if ($_has_database_error ?? false)
{
    ErrorController::database_error();
    exit(0);
}

// main handle
if (
    class_exists($class = (ucfirst($_GET['controller'] ?? 'main') . "Controller")) &&
    method_exists($class, $action = $_GET['action'] ?? '_default') &&
    $class != 'ErrorController' // forbid reading errors
)
{
    $class::$action();
}
else
{
    ErrorController::http_404();
}