
<form method="post" action="<?= loc('account', 'create_') ?>">
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
        <input id="password" type="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
               title="8 caractères au minimum, au moins un chiffre, une majuscule, une minuscule et un caractère spécial" required>
    </label>

    <label>
        Confirmation du mot de passe :
        <input id="password_confirm" type="password" name="password_confirm" required>
    </label>

    <button type="submit" class="btn btn-link">Créer le compte</button>
</form>