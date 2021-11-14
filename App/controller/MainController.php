<?php


class MainController implements IGeneral
{

    public static function get_controller_name(): string
    {
        return '';
    }

    /**
     * HOMEPAGE
     */
    public static function readAll()
    {
        RenderEngine::render(self::get_controller_name(), 'home', "Accueil");
    }

    /**
     * GET route
     * Show the login page
     */
    public static function connect()
    {
        RenderEngine::render(self::get_controller_name(), 'login', 'Connexion');
    }

    /**
     * POST route
     * Process the login form
     */
    public static function connected()
    {
        ensure_form_full(['email', 'password'], $_POST, self::get_controller_name(), 'login', 'Connexion');

        /** @var Account|null $user */
        $user = Account::select($_POST['email']);
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