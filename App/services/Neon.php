<?php


class Neon
{

    const FLASH_PREFIX = '__flash';

    private static function ensureStarted()
    {
        Session::init();

        if (!array_key_exists(self::FLASH_PREFIX, $_SESSION)) $_SESSION[self::FLASH_PREFIX] = [];
    }

    private static function add_flash(string $type, string $message)
    {
        self::ensureStarted();
        $_SESSION[self::FLASH_PREFIX][] = ['type' => $type, 'message' => $message];
    }

    public static function has_flashes(): bool
    {
        self::ensureStarted();
        return array_key_exists(self::FLASH_PREFIX, $_SESSION) && !empty($_SESSION[self::FLASH_PREFIX]);
    }

    public static function get_flashes(bool $keep = false): array
    {
        self::ensureStarted();

        $flashes = $_SESSION[self::FLASH_PREFIX];
        if (!$keep) unset($_SESSION[self::FLASH_PREFIX]);

        return $flashes;
    }


    public static function error(string $message)
    {
        self::add_flash('error', $message);
    }

    public static function success(string $message)
    {
        self::add_flash('success', $message);
    }

}