<?php
require_once Path::model('Account');

class AccountController extends AbstractCRUDController
{

    protected static $controller_name = 'account';

    protected static $routes = [
        "update" => ["update", "Mise à jour du compte"]
    ];

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
        $a = array_merge(['form_action' => 'update_', 'is_update' => true, 'account' => Account::selectByEmail($_POST['email'] ?? '')], $_POST);
        ensure_form_full(['firstname', 'lastname', 'email'], $a);
        echo var_dump($_POST);

        if (Session::get('email') != $_POST['email'] && Account::selectByEmail($_POST['email']) != null) {
            // TODO: replace with a flash
            echo "l'email existe déjà";
            redirect('account');
        } else {
            Account::update($_POST);
            redirect('account');
        }
    }

    /**
     * @inheritDoc
     */
    public static function update()
    {
        ensure_user_permission('is_owner', [$_GET['account']]);
        RenderEngine::smart_render(['form_action' => 'update_', 'is_update' => true, 'account' => Account::select($_GET['account'])]);
    }

    /**
     * @inheritDoc
     */
    public static function delete()
    {
        // TODO: Implement delete() method.
    }
}