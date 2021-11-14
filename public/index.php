<?php declare(strict_types=1);

// load the library
require_once '../App/lib/Path.php';
Path::loadLibraries();
Path::loadServices();

// Initialise the session
Session::init();


// Sanity database check
require_once Path::model('Database');

if (!Sanity::check_database())
{
    // a problem with the database occured
    require_once Path::controller('ErrorController');
    ErrorController::database_error();
    exit(0);
}
else
{
    // continue the normal process
    require_once Path::controller('router');
}