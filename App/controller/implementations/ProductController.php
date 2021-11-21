<?php
require_once Path::model('Product');


class ProductController extends AbstractCRUDController
{

    protected static $controller_name = 'product';

    protected static $routes = [
        'create' => ['update', 'Ajouter un produit'],
        'update' => ['update', 'Mettre à jour un produit'],
    ];

    /**
     * @inheritDoc
     */
    public static function create_()
    {
        ensure_user_permission('is_admin');
        self::sanitize_product();
        self::eval_image();

        $a = array_merge(['form_action' => 'create_'], $_POST);
        ensure_form_full(['name', 'slug', 'price'], $a);


        // check that the price isn't negative
        if ((int)$_POST['price'] < 0)
        {
            // TODO: flash message
            RenderEngine::smart_render($a);
        }

        // if the product already exists
        if (Product::exists($_POST['slug']))
        {
            // TODO: flash message
            RenderEngine::smart_render($a);
        }

        Product::create($_POST);
        redirect('product');
    }

    /**
     * @inheritDoc
     */
    public static function create()
    {
        ensure_user_permission('is_admin');
        RenderEngine::smart_render(['form_action' => 'create_']);
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
        ensure_user_permission('is_admin');
        self::sanitize_product();
        self::eval_image();

        $a = array_merge(['form_action' => 'update_', 'is_update' => true, 'product' => Product::select($_POST['slug'] ?? '')], $_POST);
        ensure_form_full(['name', 'slug', 'price'], $a);


        // check that the price isn't negative
        if ((int)$_POST['price'] < 0)
        {
            // TODO: flash message
            RenderEngine::smart_render($a);
        }

        Product::update($_POST);
        redirect('product');
    }

    /**
     * @inheritDoc
     */
    public static function update()
    {
        ensure_user_permission('is_admin');
        RenderEngine::smart_render(['form_action' => 'update_', 'is_update' => true, 'product' => Product::select($_GET['product'] ?? '')]);
    }

    /**
     * @inheritDoc
     */
    public static function delete()
    {
        ensure_user_permission('is_admin');
        // TODO: Implement delete() method.
    }

    private static function sanitize_product()
    {
        if (array_key_exists('name', $_POST)) $_POST['name'] = trim($_POST['name']);
        if (array_key_exists('slug', $_POST)) $_POST['slug'] = trim($_POST['slug']);
        if (array_key_exists('description', $_POST) && empty(trim($_POST['description']))) $_POST['description'] = null;
    }

    private static function eval_image()
    {
        // check if there is a cover image
        if (array_key_exists('cover', $_FILES) && !empty($_FILES['cover']['tmp_name']))
        {
            $f = fopen($_FILES['cover']['tmp_name'], 'rb');
            $_POST['cover'] = base64_encode(fread($f, filesize($_FILES['cover']['tmp_name'])));
        }
        else if (array_key_exists('cover_save', $_POST))
        {
            $_POST['cover'] = $_POST['cover_save'];
        }

        // remove the cover save if there is one
        unset($_POST['cover_save']);
    }
}