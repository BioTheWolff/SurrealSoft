<?php

class CartProduct extends Product
{
    protected $quantity = -1;
    protected $totalPrice = -1;

    public function is_multiple(): bool
    {
        return $this->quantity > 1;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        if ($this->quantity == -1) $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->price * $this->quantity;
    }

    public static function selectProductsById(array $in_array): array
    {
        if (empty($in_array)) return [];

        $in = str_repeat('?,', count($in_array) - 1) . '?';
        $stmt = self::getPDO()->prepare(parent::prepare_statement("SELECT * FROM :tablename WHERE id IN ($in)"));
        $stmt->execute($in_array);

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }
}