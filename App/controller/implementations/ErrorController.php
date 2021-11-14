<?php

class ErrorController extends AbstractController
{

    protected static $controller_name = 'error';


    public static function database_error()
    {
        http_response_code(503);
        RenderEngine::render(self::get_cn(), 'database', 'Site en maintenance');
    }

    public static function http_404()
    {
        http_response_code(404);
        RenderEngine::render(self::get_cn(), '404', 'Page non trouvée');
    }

    public static function http_403()
    {
        http_response_code(403);
        RenderEngine::render(self::get_cn(), '403', 'Accès non autorisé');
    }
}