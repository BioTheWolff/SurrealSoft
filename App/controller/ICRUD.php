<?php

/**
 * Class CRUDController
 * Abstract class that defines the CRUD design pattern to use
 */
interface ICRUD extends IGeneral
{

    /**
     * POST route
     * Creates an object in the table
     *
     * @return null
     */
    public static function created();

    /**
     * GET route
     * Returns the creation form
     *
     * @return null
     */
    public static function create();

    /**
     * GET route
     * Displays a specific object from the table (identified by a unique/primary key)
     *
     * @return null
     */
    public static function read();

    /**
     * GET route
     * Displays all objects from the table
     *
     * @return null
     */
    public static function readAll();

    /**
     * POST route
     * Updates a given object identified by a key (unique/primary)
     *
     * @return null
     */
    public static function updated();

    /**
     * GET route
     * Returns the update form
     *
     * @return null
     */
    public static function update();

    /**
     * POST route
     * Deletes a specific object from the database
     *
     * @return null
     */
    public static function delete();

}