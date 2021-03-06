<?php
require_once Path::model('CartProduct');

class CartController extends AbstractController
{

    protected static $controller_name = 'cart';

    public static function _default()
    {
        self::display();
    }

    public static function display()
    {
        RenderEngine::render(self::get_cn(), 'display', 'Panier',
            ['cart_items' => get_cart_products()]);
    }

    public static function add()
    {
        Cart::add($_GET['product'], $_GET['quantity'] ?? 1);
        redirect('product');
    }

    public static function remove()
    {
        Cart::remove($_GET['product'], $_GET['quantity'] ?? 1);
        redirect('cart');
    }

}