
<form action="<?= loc(null, 'connect_', ['nonce' => $_GET['nonce'] ?? null]) ?>" method="post">
    <label>E-mail
        <input type="email" name="email" value="<?= $rvar_extra_email ?? '' ?>" required>
    </label>

    <label>Mot de passe
        <input type="password" name="password" required>
    </label>

    <input type="submit" value="Se connecter">
</form>