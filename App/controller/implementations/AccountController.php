<?php
require_once Path::model('Account');

class AccountController extends AbstractCRUDController
{

    protected static $controller_name = 'account';

    protected static $routes = [
        'create' => ['create', 'Inscription']
    ];

    /**
     * @inheritDoc
     */
    public static function create_()
    {
        redirect_if_no_permission('is_not_connected');
        ensure_form_full(['firstname', 'lastname', 'email', 'password', 'password_confirm'], $_POST);

        // pattern email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Neon::error("L'email est invalide.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        // unicité email
        if (!is_null(Account::select($_POST['email']))) {
            Neon::error("Un compte est déjà associé à cet email.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        // égalité mot de passe
        if ($_POST['password'] != $_POST['password_confirm']) {
            Neon::error("Les mots de passe ne correspondent pas.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        // pattern mot de passe
        if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/", $_POST['password'])) {
            Neon::error("Le mot de passe ne remplit pas les critères demandés");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        // test dictionary.php
        if (in_array($_POST['password'], (require Path::get(['config', 'dictionary'])))) {
            Neon::error("Le mot de passe est trop faible.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        // hach le mot de passe pour le mettre dans la base de données
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $res = Account::create([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'password' => $hash,
            'nonce' => null
        ]);

        // database failure
        if (!$res)
        {
            Neon::error("Erreur de la base de données.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        redirect();
    }

    /**
     * @inheritDoc
     */
    public static function create()
    {
        redirect_if_no_permission('is_not_connected');
        RenderEngine::smart_render();
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
        RenderEngine::render(self::get_cn(), 'list', 'Liste des utilisateurs',
            ['users' => Account::selectAll()]);
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