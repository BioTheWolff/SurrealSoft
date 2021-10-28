<?php

/**
 * Class CRUDController
 * Abstract class that defines the CRUD design pattern to use
 */
abstract class CRUDController
{

    /**
     *
     * @return null
     */
    public abstract function create();

    public abstract function read();

    public abstract function readAll();

    public abstract function update();

    public abstract function delete();

}