<?php declare(strict_types=1);


class Database
{

    /**
     * @var PDO $pdo;
     */
    private static $pdo;

    protected static $tablename = null;
    protected static $primarykey = null;

    protected static $non_nullable_fields = [];

    /**
     * Called from the children classes' constructor to check that all fields were filled by PDO
     */
    protected function check_non_nullable_fields()
    {
        foreach (static::$non_nullable_fields as $field)
        {
            if (is_null($this->$field)) throw new RuntimeException("Field $field is null.");
        }
    }



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

    /**
     * Prepares the SQL statement to adapt it to the desired table.
     * Replaces
     *  - (required) `:tablename` by the current table name
     *  - (required) `:primary` by the current primary key
     *  - (optional) `:updatearr=''` by an associative array of parameters to use in PDOStatement prepare (i.e. `login=:login,user=:user`)
     *  - (optional) `:insertarr` by a bracketed array of statement parameters (i.e. `(:login,:user)`)
     *
     * Warning: Only associative array keys are used. This method is prepared to recieve the `$_POST` or `$_GET` arrays
     *
     * @param string $query the prepared string to fill in
     * @param array|null $arr the array to give. See above for details.
     * @return string the prepared SQL statement query
     */
    private static function prepare_statement(string $query, array $arr = null): string
    {
        if (is_null(static::$tablename) || is_null(static::$primarykey))
        {
            throw new RuntimeException("No redefinition of table name or primary key in class " . static::class);
        }

        $query = str_replace(':primary', static::$primarykey,
            str_replace(':tablename', Config::getInstance()->get("database.table.prefix", "") . static::$tablename, $query)
        );

        if (strpos($query, ":updatearr=''") !== false)
        {
            $s = "";
            foreach ($arr as $k => $v) $s .= "$k=:$k,";
            $query = str_replace(":updatearr=''", trim($s, ','), $query);
        }

        if (strpos($query, ':insertarr') !== false)
        {
            $s = "(";
            foreach ($arr as $k => $v) $s .= ":$k,";
            $query = str_replace(":updatearr=''", trim($s, ',') . ")", $query);
        }

        return $query;
    }



    public static function selectAll(): array
    {
        $stmt = self::getPDO()->prepare(self::prepare_statement("SELECT * FROM :tablename"));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function select(string $value)
    {
        $stmt = self::getPDO()->prepare(self::prepare_statement("SELECT * FROM :tablename WHERE :primary = :val"));
        $stmt->execute(['val' => $value]);

        $res = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        return $res[0] ?? null;
    }

}