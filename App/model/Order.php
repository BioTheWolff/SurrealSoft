<?php


class Order extends Database
{
    protected static $tablename = 'orders';
    protected static $primarykey = 'id';

    protected $id;
    protected $clientId;
    protected $date;
    protected $amount;
    protected $productsCount;

    protected static $non_nullable_fields = ['id', 'clientId', 'date'];

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

    /**
     * @return mixed
     */
    public function getProductsCount()
    {
        return $this->productsCount;
    }

    public function get(string $parameter, $default = null)
    {
        return property_exists($this, $parameter) ? $this->$parameter : $default;
    }


    // REDEFINITIONS

    /**
     * Please do NOT use yourself. Use createOrder instead
     *
     * @see Order::createOrder()
     * @param array $values
     * @return bool
     */
    public static function create(array $values): bool
    {
        if (!is_array_full(['clientId','date', 'products'], $values)) return false;

        $products = $values['products'];
        unset($values['products']);


        // create order row
        $o_stmt = self::getPDO()->prepare(self::prepare_statement("INSERT INTO :tablename (:insertkeys) VALUES (:insertvals)", $values));
        $o_stmt->execute($values);
        if ($o_stmt->rowCount() == 0) return false;

        // get the order id
        $id_stmt = self::getPDO()->prepare(self::prepare_statement("SELECT id FROM :tablename WHERE clientId = :clientId AND date = :date"));
        $id_stmt->execute($values);
        $orderId = $id_stmt->fetch(PDO::FETCH_NUM);
        if ($orderId === false) return false;
        $orderId = $orderId[0];


        // prepare the products' insertion in the association table
        $query_insertion = "";
        for ($i = 0; $i < count($products); ++$i) $query_insertion .= "(?,?,?,?),";
        $query_insertion = trim($query_insertion, ",");

        // prepare the values' insertion by formatting them to fit the format above
        $insertion_values = [];
        foreach ($products as $p)
        {
            /* @var CartProduct $p */
            $insertion_values[] = $orderId;
            $insertion_values[] = $p->getId();
            $insertion_values[] = $p->getQuantity();
            $insertion_values[] = $p->getPrice();
        }


        // finally, insert everything
        $final_stmt = self::getPDO()->prepare("INSERT INTO surrealsoft__orderedProducts VALUES $query_insertion");
        $final_stmt->execute($insertion_values);

        return $final_stmt->rowCount() > 0;
    }

    /**
     * Please use this function to create a new order in the database
     *
     * @param int $clientId the client ID
     * @param CartProduct[] $products the products in the cart
     * @return bool if the request failed
     */
    public static function createOrder(int $clientId, array $products): bool
    {
        return self::create(['clientId' => $clientId, 'date' => date("Y-m-d H:i:s"), 'products' => $products]);
    }

    /**
     * @param string $user_id the user's id
     * @return Order[]
     */
    public static function selectOrdersForUser(string $user_id): array
    {
        $stmt = self::getPDO()->prepare(
            "SELECT o.* FROM surrealsoft__orders o 
                    JOIN surrealsoft__accounts a 
                        ON a.id = o.clientId
                        WHERE a.id = :val");
        $stmt->execute(['val' => $user_id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
