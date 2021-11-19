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
}