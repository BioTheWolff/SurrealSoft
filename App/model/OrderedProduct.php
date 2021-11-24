<?php

class OrderedProduct extends Product
{
    protected static $tablename = 'orderedProducts';
    protected static $primarykey = 'orderId';

    protected $quantity;

    // Redirection par le parent pour agir comme un produit normal
    public static function select(string $value)
    {
        return parent::select($value);
    }

    // Redirection par le parent pour agir comme un produit normal
    public static function selectAll(): array
    {
        return parent::selectAll();
    }

    // Redirection par le parent pour agir comme un produit normal
    public static function selectSome(array $in_array): array
    {
        return parent::selectSome($in_array);
    }

    /**
     * @param int $id the order id
     * @return OrderedProduct[]
     */
    public static function allProductsForOrder(int $id): array
    {
        $stmt = self::getPDO()->prepare(self::prepare_statement(
            "SELECT p.id, p.slug, p.name, p.description, o.price, p.cover, o.quantity
                    FROM surrealsoft__orderedProducts o 
                    JOIN surrealsoft__products p ON o.productId = p.id
                    WHERE :primary = :val"
        ));

        $stmt->execute(['val' => $id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}