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
}