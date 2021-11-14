<?php


class Account extends Database
{
    protected static $tablename = 'accounts';
    protected static $primarykey = 'email';

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
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
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

}