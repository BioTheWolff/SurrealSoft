<?php

$a = ${v('account')};
/** @var Account $a */

$action = loc(
        $rvar_cn ?? null,
        ${v('form_action')} ?? null,
        ['account' => $a->getId()]
);

?>

<form method="post" action="<?= $action ?>" enctype="multipart/form-data" class="acount-form">
    <fieldset class="acount-fildset">
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

    <input id="modifer-account" type="submit" class="btn btn-link" value="Mettre à jour le compte">
</form>