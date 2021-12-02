<h2>Connexion</h2>
<form action="<?= loc(null, 'connect_', ['nonce' => $_GET['nonce'] ?? null]) ?>" method="post" class="connection">
    <div class="div-connexion">
        <label>E-mail
            <input type="email" name="email" value="<?= $rvar_extra_email ?? '' ?>" required>
        </label>

        <label>Mot de passe
            <input type="password" name="password" required>
        </label>
    </div>

    <input id="seconnecter" type="submit" class="btn btn-link" value="Se connecter">
</form>