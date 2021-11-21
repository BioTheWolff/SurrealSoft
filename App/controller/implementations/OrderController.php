<?php
require_once Path::model('Order');


class OrderController extends AbstractCrudController
{

    protected static $controller_name = 'order';

    /**
     * @inheritDoc
     */
    public static function create_()
    {
        // TODO: Implement created() method.
    }

    /**
     * @inheritDoc
     */
    public static function create()
    {
        // TODO: Implement create() method.
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
