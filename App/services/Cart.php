<?php


class Cart
{
    const CART_PREFIX = '__cart';

    private static function ensureStarted()
    {
        Session::init();

        if (!array_key_exists(self::CART_PREFIX, $_SESSION)) $_SESSION[self::CART_PREFIX] = serialize([]);
    }



    public static function add(int $id, int $quantity = 1)
    {
        if ($quantity <= 0) return;

        self::ensureStarted();

        /** @var array $cart */
        $cart = unserialize($_SESSION[self::CART_PREFIX]);

        if (array_key_exists($id, $cart))
        {
            // add the quantity
            $cart[$id] += $quantity;
        }
        else
        {
            // set the quantity
            $cart[$id] = $quantity;
        }

        // save the modified cart
        $_SESSION[self::CART_PREFIX] = $cart;
    }

    public static function remove(int $id, int $quantity)
    {
        if ($quantity <= 0) return;

        self::ensureStarted();

        /** @var array $cart */
        $cart = unserialize($_SESSION[self::CART_PREFIX]);

        if (array_key_exists($id, $cart))
        {
            if ($quantity >= $cart[$id]) unset($cart[$id]); // remove more than we have right now
            else $cart[$id] -= $quantity;
        }

        // save the modified cart
        $_SESSION[self::CART_PREFIX] = $cart;
    }



    public static function is_empty(): bool
    {
        self::ensureStarted();
        return empty(unserialize($_SESSION[self::CART_PREFIX]));
    }

    public static function get_items(): array
    {
        self::ensureStarted();
        if (self::is_empty()) return [];

        return array_keys(unserialize($_SESSION[self::CART_PREFIX]));
    }

    /**
     * @param CartProduct[] $products
     */
    public static function add_product_quantities(array $products): array
    {
        self::ensureStarted();

        /** @var array $cart */
        $cart = unserialize($_SESSION[self::CART_PREFIX]);

        foreach ($products as $product) $product->setQuantity($cart[$product->getId()]);

        return $products;
    }
}