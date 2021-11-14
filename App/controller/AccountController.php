<?php
require_once Path::model('Account');

class AccountController implements ICRUD
{

    public static function get_controller_name(): string
    {
        return 'account';
    }

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
        RenderEngine::render(self::get_controller_name(), 'list', 'Liste des utilisateurs',
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
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public static function delete()
    {
        // TODO: Implement delete() method.
    }
}