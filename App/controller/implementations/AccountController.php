<?php
require_once Path::model('Account');

class AccountController extends AbstractCRUDController
{

    protected static $controller_name = 'account';

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
        RenderEngine::render(self::get_cn(), 'details', 'Détails du compte',
            [ 'account' => Account::select($_GET['account'])]);
    }

    /**
     * @inheritDoc
     */
    public static function readAll()
    {
        if (Session::is_admin()) {
            RenderEngine::render(self::get_cn(), 'list', 'Liste des utilisateurs',
                ['users' => Account::selectAll()]);
        } else {
            RenderEngine::render(self::get_cn(), 'details', 'Détails du compte',
                [ 'account' => Account::select(Session::get('id'))]);
        }
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