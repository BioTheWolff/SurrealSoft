
<form action="?action=connected" method="post">
    <label>E-mail
        <input type="email" name="email" value="<?= $rvar_extra_email ?? '' ?>">
    </label>

    <label>Mot de passe
        <input type="password" name="password" value="<?= $rvar_extra_password ?? '' ?>">
    </label>

    <input type="submit" value="Se connecter">
</form>