<?php


class Account extends Database
{
    protected static $tablename = 'accounts';
    protected static $primarykey = 'id';

    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $admin;
    protected $nonce;

    protected static $non_nullable_fields = ['id', 'firstname', 'lastname', 'email', 'password', 'admin'];

    public function __construct()
    {
        $this->check_non_nullable_fields();
    }

    public function password_matches(string $plain_password): bool
    {
        return password_verify($plain_password, $this->password);
    }

    public function removeNonce(): bool
    {
        return Account::update(['email' => $this->email, 'nonce' => null]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @return mixed|null
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    public static function selectByEmail(string $value)
    {
        $stmt = self::getPDO()->prepare(self::prepare_statement("SELECT * FROM :tablename WHERE email = :val"));
        $stmt->execute(['val' => $value]);

        $res = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        return $res[0] ?? null;
    }

    public function get(string $parameter, $default = null)
    {
        return property_exists($this, $parameter) ? $this->$parameter : $default;
    }

}