<?php declare(strict_types=1);


class Database
{

    /**
     * @var PDO $pdo;
     */
    private static $pdo;

    private static function init_pdo()
    {
        $keys = ['database.adapter', 'database.host', 'database.dbname', 'database.user', 'database.pass', 'database.port'];
        $conf = Config::getInstance()->getm($keys);

        if (in_array(null, $conf)) throw new RuntimeException("Key not found in config.");

        self::$pdo = new PDO(
            "{$conf[0]}:host={$conf[1]};dbname={$conf[2]}",
            $conf[3], $conf[4],
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        );
    }

    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if (is_null(self::$pdo)) self::init_pdo();
        return self::$pdo;
    }

}