
<h2>Inscription</h2>
<form class="inscription" method="post" action="<?= loc('account', 'create_') ?>">
    <div class="div-inscription">
        <label>
            Nom :
            <input type="text" name="firstname" placeholder="Dupont" value="<?= $rvar_extra_firstname ?? '' ?>" required>
        </label>
        <label>
            Prénom :
            <input type="text" name="lastname" placeholder="Jean" value="<?= $rvar_extra_lastname ?? '' ?>" required>
        </label>
        <label>
            Email :
            <input type="email" name="email" placeholder="jean.dupont@gmail.com" value="<?= $rvar_extra_email ?? '' ?>" required>
        </label>

        <label>
            Mot de passe :
            <input id="password" type="password" name="password"
                   title="8 caractères au minimum, au moins un chiffre, une majuscule, une minuscule" required>
        </label>

        <label>
            Confirmation du mot de passe :
            <input id="password_confirm" type="password" name="password_confirm" required>
        </label>
    </div>

    <button type="submit" class="btn btn-link">Créer un compte</button>
</form>