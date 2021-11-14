<?php

class ErrorController implements IGeneral
{

    /**
     * @inheritDoc
     */
    public static function get_controller_name(): string
    {
        return 'error';
    }


    public static function database_error()
    {
        echo 'nope';
    }

    public static function http_404()
    {
        http_response_code(404);
        RenderEngine::render(self::get_controller_name(), '404', 'Page non trouvée');
    }

    public static function http_403()
    {
        http_response_code(403);
        RenderEngine::render(self::get_controller_name(), '403', 'Accès non autorisé');
    }
}