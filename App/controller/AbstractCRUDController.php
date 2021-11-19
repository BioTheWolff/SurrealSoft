<?php

/**
 * Class CRUDController
 * Abstract class that defines the CRUD design pattern to use
 */
abstract class AbstractCRUDController extends AbstractController
{

    public static function _default()
    {
        static::readAll();
    }

    /**
     * POST route
     * Creates an object in the table
     */
    public static abstract function create_();

    /**
     * GET route
     * Returns the creation form
     */
    public static abstract function create();

    /**
     * GET route
     * Displays a specific object from the table (identified by a unique/primary key)
     */
    public static abstract function read();

    /**
     * GET route
     * Displays all objects from the table
     */
    public static function readAll() {}

    /**
     * POST route
     * Updates a given object identified by a key (unique/primary)
     */
    public static abstract function update_();

    /**
     * GET route
     * Returns the update form
     */
    public static abstract function update();

    /**
     * POST route
     * Deletes a specific object from the database
     */
    public static abstract function delete();

}