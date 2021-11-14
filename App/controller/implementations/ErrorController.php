<?php

class ErrorController implements AbstractController
{

    /**
     * @inheritDoc
     */
    public static function _get_controller_name(): string
    {
        return 'error';
    }

    public static function _get_bound_views(): array
    {
        return [];
    }


    public static function database_error()
    {
        http_response_code(503);
        RenderEngine::_render(self::_get_controller_name(), 'database', 'Site en maintenance');
    }

    public static function http_404()
    {
        http_response_code(404);
        RenderEngine::_render(self::_get_controller_name(), '404', 'Page non trouvée');
    }

    public static function http_403()
    {
        http_response_code(403);
        RenderEngine::_render(self::_get_controller_name(), '403', 'Accès non autorisé');
    }
}