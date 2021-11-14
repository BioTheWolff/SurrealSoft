<?php

class Loader
{
    public static function loadLibraries()
    {
        foreach (require('_libs.php') as $file) require_once($file);
    }

    public static function loadServices()
    {
        foreach (require(Path::getapp(['services', '_services'])) as $file) require_once(Path::getapp(['services', basename($file, '.php')]));
    }

    public static function loadImplementedControllers()
    {
        foreach (require(Path::getapp(['controller', 'implementations', '_impl'])) as $file)
            require_once(Path::getapp(['controller', 'implementations', basename($file, '.php')]));
    }
}