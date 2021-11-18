<?php


class CartController extends AbstractController
{

    protected static $controller_name = 'cart';

    public static function _default()
    {
        self::display();
    }

    public static function display()
    {

    }

    public static function add()
    {
        Cart::add($_GET['product']);
        redirect();
    }

}