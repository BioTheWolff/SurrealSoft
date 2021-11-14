<?php

class Session
{

    const USER_PREFIX = '__user';

    public static function init()
    {
        self::ensureStarted();
    }

    /**
     * @throws Exception if PHP sessions are disabled
     */
    private static function ensureStarted()
    {
        $status = session_status();

        if ($status == PHP_SESSION_NONE)
            session_start();
        else if ($status == PHP_SESSION_DISABLED)
            throw new Exception('PHP Session is disabled', E_ERROR);
    }

    public static function get(string $key, $default = null)
    {
        self::ensureStarted();

        if (!self::is_connected()) return $default;
        return $_SESSION[self::USER_PREFIX][$key] ?? $default;
    }


    public static function is_connected(): bool
    {
        self::ensureStarted();
        return array_key_exists(self::USER_PREFIX, $_SESSION);
    }

    public static function is_admin(): bool
    {
        self::ensureStarted();
        return self::is_connected() && self::get("admin", false);
    }

    public static function is_owner(string $owner_email): bool
    {
        return self::is_admin() || self::get("email") == $owner_email;
    }
}