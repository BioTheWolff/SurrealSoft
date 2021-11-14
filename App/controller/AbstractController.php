<?php

abstract class AbstractController
{
    protected static $routes = [];
    protected static $controller_name = '';

    protected static function get_route_view(string $route)
    {
        return array_key_exists($route, static::$routes) ? static::$routes[$route] : null;
    }

    /**
     * Returns the name of the controller.
     * Is used to look up the content directory in the views.
     *
     * @return string
     */
    public static function get_cn(): string
    {
        return static::$controller_name;
    }
}