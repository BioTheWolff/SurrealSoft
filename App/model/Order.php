<?php


class Order extends Database
{
    protected static $tablename = 'orders';
    protected static $primarykey = 'id';

    protected $id;
    protected $clientId;
    protected $date;
    protected $amount;

    protected static $non_nullable_fields = ['id', 'clientId', 'date', 'amount'];

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
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function get(string $parameter, $default = null)
    {
        return property_exists($this, $parameter) ? $this->$parameter : $default;
    }
}
