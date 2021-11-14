<?php

interface IGeneral
{
    /**
     * Returns the name of the controller.
     * Is used to look up the content directory in the views.
     *
     * @return string
     */
    public static function get_controller_name(): string;
}