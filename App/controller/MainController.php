<?php


class MainController implements IGeneral
{

    /**
     * HOMEPAGE
     */
    public static function readAll()
    {
        RenderEngine::render(self::get_controller_name(), 'home', "Accueil");
    }

    public static function get_controller_name(): string
    {
        return '';
    }
}