<?php

class Session
{

    const USER_PREFIX = '__user';


    public static function get(string $key, $default = null)
    {
        if (!self::is_connected()) return $default;
        return $_SESSION[self::USER_PREFIX][$key] ?? $default;
    }


    public static function is_connected(): bool
    {
        return array_key_exists(self::USER_PREFIX, $_SESSION);
    }

    public static function is_admin(): bool
    {
        return self::is_connected() && self::get("admin", false);
    }
}