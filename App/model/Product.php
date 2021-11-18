<?php


class Product extends Database
{
    protected static $tablename = 'products';
    protected static $primarykey = 'slug';

    protected $id;
    protected $slug;
    protected $name;
    protected $description;
    protected $price;

    protected static $non_nullable_fields = ['id', 'slug', 'name', 'price'];

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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function get(string $parameter, $default = null)
    {
        return property_exists($this, $parameter) ? $this->$parameter : $default;
    }

}