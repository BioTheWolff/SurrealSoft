<?php


abstract class CRUDModel
{

    /**
     * Creates the object in the table
     *
     * @return null
     */
    public abstract function create();

    /**
     * Reads an object in the table and returns it as an instance of the class
     *
     * @return mixed
     */
    public static abstract function read(): CRUDModel;

    /**
     * Returns an array of instances created by reading from the database
     *
     * @return array[]
     */
    public static abstract function readAll(): array;

    /**
     * Updates the database to the values of this instance, if possible
     *
     * Note: calling update on a non-existing database object is an undefined behaviour.
     * Children classes might implement UPSERT queries.
     *
     * @return null
     */
    public abstract function update();

    /**
     * Deletes this object from the database, if possible
     *
     * Note: calling delete on a non-existing database object will have no impact.
     * Children classes are expected to follow this behaviour.
     *
     * @return null
     */
    public abstract function delete();
}