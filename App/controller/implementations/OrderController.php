<?php
require_once Path::model('Order');
require_once Path::model('OrderedProduct');


class OrderController extends AbstractCrudController
{

    protected static $controller_name = 'order';

    /**
     * @inheritDoc
     */
    public static function create_()
    {

    }

    /**
     * @inheritDoc
     */
    public static function create()
    {
        // be sure that the user has an account
        // even though the cart is independant from being connected to an account
        redirect_if_no_permission('is_connected', null, 'connect');

        // use the user ID to create the order
        Order::createOrder(Session::get('id'), get_cart_products());

        // empty the user's cart
        Cart::flush_cart();
    }

    /**
     * @inheritDoc
     */
    public static function read()
    {
        RenderEngine::render(
            self::get_cn(),
            'details',
            'Order details',
            ['order' => Order::select($_GET['order'])]
        );
    }

    /**
     * @inheritDoc
     */
    public static function readAll()
    {
        ensure_user_permission('is_admin');
        RenderEngine::render(
            self::get_cn(),
            'list',
            'Orders list',
            ['orders' => Order::selectAll()]
        );
    }

    /**
     * @inheritDoc
     */
    public static function update_()
    {
        // TODO: Implement updated() method.
    }

    /**
     * @inheritDoc
     */
    public static function update()
    {
        ensure_user_permission('is_owner', [$_GET['email']]);
        // insérer fonction ici
    }

    /**
     * @inheritDoc
     */
    public static function delete()
    {
        // TODO: Implement delete() method.
    }
}
