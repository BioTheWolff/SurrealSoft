<?php


class MainController extends AbstractController
{

    /**
     * HOMEPAGE
     */
    public static function readAll()
    {
        RenderEngine::_render(self::get_cn(), 'home', "Accueil");
    }

    /**
     * GET route
     * Show the login page
     */
    public static function connect()
    {
        RenderEngine::_render(self::get_cn(), 'login', 'Connexion');
    }

    /**
     * POST route
     * Process the login form
     */
    public static function connected()
    {
        ensure_form_full(['email', 'password'], $_POST, self::get_cn(), 'login', 'Connexion');

        /** @var Account|null $user */
        $user = Account::select($_POST['email']);

        if (is_null($user) || !$user->password_matches($_POST['password']))
        {

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