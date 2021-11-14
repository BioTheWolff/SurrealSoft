<?php

interface IGeneral
{
    /**
     * Returns the name of the controller.
     * Is used to look up the content directory in the views.
     *
     * @return string
     */
    public static function _get_controller_name(): string;

    /**
     * Returns an array of 
     *
     * @return array the associative array of CRUD => view info
     */
    public static function _get_bound_views(): array;
}