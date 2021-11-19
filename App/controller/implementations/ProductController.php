<?php
require_once Path::model('Product');


class ProductController extends AbstractCRUDController
{

    protected static $controller_name = 'product';

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
        RenderEngine::render(self::get_cn(), 'details', 'Détails du produit',
            [ 'product' => Product::select($_GET['product'])]);
    }

    /**
     * @inheritDoc
     */
    public static function readAll()
    {
        RenderEngine::render(self::get_cn(), 'list', 'Liste des produits',
            ['products' => Product::selectAll()]);
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