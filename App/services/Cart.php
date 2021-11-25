<?php


class Cart
{
    const CART_PREFIX = '__cart';

    private static function ensureStarted()
    {
        Session::init();

        if (!array_key_exists(self::CART_PREFIX, $_SESSION)) $_SESSION[self::CART_PREFIX] = [];
    }



    public static function add(int $id, int $quantity = 1)
    {
        if ($quantity <= 0) return;

        self::ensureStarted();

        if (array_key_exists($id, $_SESSION[self::CART_PREFIX]))
        {
            // add the quantity
            $_SESSION[self::CART_PREFIX][$id] += $quantity;
        }
        else
        {
            // set the quantity
            $_SESSION[self::CART_PREFIX][$id] = $quantity;
        }
    }

    public static function remove(int $id, int $quantity)
    {
        if ($quantity <= 0) return;

        self::ensureStarted();

        if (array_key_exists($id, $_SESSION[self::CART_PREFIX]))
        {
            if ($quantity >= $_SESSION[self::CART_PREFIX][$id]) unset($_SESSION[self::CART_PREFIX][$id]); // remove more than we have right now
            else $_SESSION[self::CART_PREFIX][$id] -= $quantity;
        }
    }



    public static function is_empty(): bool
    {
        self::ensureStarted();
        return !array_key_exists(self::CART_PREFIX, $_SESSION) ||
            empty($_SESSION[self::CART_PREFIX]);
    }

    public static function get_items(): array
    {
        self::ensureStarted();
        if (self::is_empty()) return [];

        return array_keys($_SESSION[self::CART_PREFIX]);
    }

    public static function get_quantities()
    {
        self::ensureStarted();
        if (self::is_empty()) return 0;

        $count = 0;
        foreach (array_values($_SESSION[self::CART_PREFIX]) as $v) $count += $v;
        return $count;
    }

    /**
     * @param CartProduct[] $products
     */
    public static function add_product_quantities(array $products): array
    {
        self::ensureStarted();

        if (!self::is_empty())
        {
            foreach ($products as $product) $product->setQuantity($_SESSION[self::CART_PREFIX][$product->getId()]);
        }

        return $products;
    }

    public static function flush_cart()
    {
        self::ensureStarted();

        if (!self::is_empty()) $_SESSION[self::CART_PREFIX] = [];
    }
}