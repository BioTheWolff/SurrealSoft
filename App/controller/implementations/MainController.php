<?php


class MainController extends AbstractController
{

    protected static $routes = [
        'connect' => ['login', 'Connexion']
    ];

    /**
     * HOMEPAGE
     */
    public static function _default()
    {
        RenderEngine::render(self::get_cn(), 'home', "Accueil");
    }

    /**
     * GET route
     * Show the login page
     */
    public static function connect()
    {
        redirect_if_no_permission('is_not_connected');
        RenderEngine::smart_render();
    }

    /**
     * POST route
     * Process the login form
     */
    public static function connect_()
    {
        redirect_if_no_permission('is_not_connected');
        ensure_form_full(['email', 'password'], $_POST);

        /** @var Account|null $user */
        $user = Account::selectByEmail($_POST['email']);

        if (is_null($user) || !$user->password_matches($_POST['password']))
        {
            Neon::error("Email ou mot de passe incorrect.");
            RenderEngine::smart_render($_POST);
            RenderEngine::end();
        }

        if (!is_null($user->getNonce()))
        {
            // aucun nonce
            if (!array_key_exists('nonce', $_GET) || !($_GET['nonce'] == $user->getNonce()))
            {
                Neon::error("Votre compte n'est pas vérifié, merci de regarder votre adresse email associée.");
                RenderEngine::smart_render($_POST);
                RenderEngine::end();
            }
            // nonce confirmé, on retire le nonce et on connecte l'utilisateur
            else
            {
                $user->removeNonce();
                Neon::success("Votre adresse email a été vérifiée avec succès !");
            }
        }

        Neon::success("Vous avez été connecté avec succès !");
        Session::connect_user($user);
        header('Location: ./');
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