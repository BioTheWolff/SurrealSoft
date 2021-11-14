<?php

abstract class AbstractController
{

    /**
     * Used in pair with smart_render to map route name from function name.
     *
     * IMPORTANT: define the function names (connect, connected) the same as the route (connect).
     *
     * NO "-ed" IN ROUTE KEYS.
     *
     * @see RenderEngine::smart_render()
     * @var array $routes
     */
    protected static $routes = [];

    protected static $controller_name = '';

    /**
     * Gets the view info from the given route.
     * smart_render relies on this function, combined with the use of $routes, to map from function name
     *
     * @see AbstractController::$routes
     * @see RenderEngine::smart_render()
     * @param string $route
     * @return mixed|null
     */
    public static function get_route_view(string $route)
    {
        $route = preg_replace('/^(.+?)(ed)?$/', '\1', $route);
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