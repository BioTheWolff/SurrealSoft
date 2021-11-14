<?php

class Session
{

    const USER_PREFIX = '__user';

    private static $instance;

    public static function getInstance(): Session
    {
        if (is_null(self::$instance)) self::$instance = new self;
        return self::$instance;
    }

    /**
     * @throws Exception if PHP sessions are disabled
     */
    private function __construct()
    {
        $status = session_status();

        if ($status == PHP_SESSION_NONE)
            session_start();
        else if ($status == PHP_SESSION_DISABLED)
            throw new Exception('PHP Session is disabled', E_ERROR);
    }

    public function get(string $key, $default = null)
    {
        if (!$this->is_connected()) return $default;
        return $_SESSION[self::USER_PREFIX][$key] ?? $default;
    }


    public function is_connected(): bool
    {
        return array_key_exists(self::USER_PREFIX, $_SESSION);
    }

    public function is_admin(): bool
    {
        return self::is_connected() && self::get("admin", false);
    }
}