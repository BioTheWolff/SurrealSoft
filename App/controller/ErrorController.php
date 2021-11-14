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

    public static function query_error()
    {
        echo 'error';
    }
}