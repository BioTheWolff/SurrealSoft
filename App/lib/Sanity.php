<?php

class Sanity
{

    public static function check_database(): bool
    {
        try
        {
            Database::getPDO();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

}