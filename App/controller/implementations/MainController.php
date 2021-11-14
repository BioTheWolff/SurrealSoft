<?php


class MainController extends AbstractController
{

    protected static $routes = [
        'connect' => ['login', 'Connexion']
    ];

    /**
     * HOMEPAGE
     */
    public static function readAll()
    {
        RenderEngine::render(self::get_cn(), 'home', "Accueil");
    }

    /**
     * GET route
     * Show the login page
     */
    public static function connect()
    {
        RenderEngine::smart_render();
    }

    /**
     * POST route
     * Process the login form
     */
    public static function connected()
    {
        ensure_form_full(['email', 'password'], $_POST);

        /** @var Account|null $user */
        $user = Account::select($_POST['email']);

        if (is_null($user) || !$user->password_matches($_POST['password']))
        {
            echo "bad";
            RenderEngine::smart_render();
        }
    }

    /**
     * GET route
     * logout the user and redirect to homepage
     */
    public static function logout()
    {
        Session::unset_user_session();
        header('Location: ./');
    }
}