<?php
require_once Path::model('Account');

class AccountController extends AbstractCRUDController
{

    protected static $controller_name = 'account';

    /**
     * @inheritDoc
     */
    public static function created()
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
        // TODO: Implement read() method.
    }

    /**
     * @inheritDoc
     */
    public static function readAll()
    {
        ensure_user_permission('is_admin');
        RenderEngine::_render(self::get_cn(), 'list', 'Liste des utilisateurs',
            ['users' => Account::selectAll()]);
    }

    /**
     * @inheritDoc
     */
    public static function updated()
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