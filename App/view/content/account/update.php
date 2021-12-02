<?php

$a = ${v('account')};
/** @var Account $a */

?>

<form method="post" action="<?= loc($rvar_cn ?? null, ${v('form_action')} ?? null) ?>" enctype="multipart/form-data">
    <fieldset>
        <legend>Détails du compte</legend>

        <label>
            Nom:
            <input type="text" name="firstname" value="<?= $a->getFirstname() ?? ${v('firstname')} ?? '' ?>" required>
        </label>

        <label>
            Prénom:
            <input type="text" name="lastname" value="<?= $a->getLastname() ?? ${v('lastname')} ?? '' ?>" required>
        </label>

        <label>
            Email:
            <input type="text" name="email" value="<?= $a->getEmail() ?? ${v('email')} ?? '' ?>" required>
        </label>
    </fieldset>

    <input type="submit" value="Mettre à jour le compte">
</form>