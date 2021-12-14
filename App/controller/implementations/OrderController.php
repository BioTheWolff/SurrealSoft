<?php
require_once Path::model('Order');
require_once Path::model('OrderedProduct');


class OrderController extends AbstractCrudController
{

    protected static $controller_name = 'order';

    protected static $routes = [
        'read' => ['details', 'Détails de la commande'],
        'readAll' => ['list', 'Liste des commandes']
    ];

    /**
     * @inheritDoc
     */
    public static function create_()
    {
        RenderEngine::render(self::get_cn(), 'created', 'Commande effectuée');
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

        // redirect to the "order completed" page
        redirect('order', 'create_');
    }

    /**
     * @inheritDoc
     */
    public static function read()
    {
        RenderEngine::smart_render(
            [
                'order' => Order::select($_GET['order']),
                'products' => OrderedProduct::allProductsForOrder($_GET['order'])
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public static function readAll()
    {
        // if an account ID is given
        if (array_key_exists('account',$_GET))
        {
            $a = $_GET['account'];
            ensure_user_permission('is_owner', [$a]);
            RenderEngine::smart_render(['orders' => Order::selectOrdersForUser($a)]);
        }

        // if none is given, we try to display the admin route
        else
        {
            ensure_user_permission('is_admin');
            RenderEngine::smart_render(['orders' => Order::selectAll()]);
        }
    }

    /**
     * @inheritDoc
     */
    public static function update_()
    {
        http_403(); // impossible de modifier une commande une fois passée
    }

    /**
     * @inheritDoc
     */
    public static function update()
    {
        http_403(); // impossible de modifier une commande une fois passée
    }

    /**
     * @inheritDoc
     */
    public static function delete()
    {
        // impossible de supprimer une commande !
        // seulement d'en changer son état, ce qui n'est pas implémenté ici
        http_403();
    }
}
