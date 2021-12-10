<?php

/** @var Account $a */
$a = $rvar_extra_account ?? null;
?>

<?php if (Session::is_admin()): ?>
    <a class="btn btn-link" href="<?= loc("account", "readAll") ?>">Voir tous les utilisateurs</a>
<?php endif; ?>

<?php if(empty($a)): ?>

    <div class="no-content">Aucun compte trouvé sous cet identifiant.</div>

<?php else: ?>

    <h2>Votre compte:</h2>
    <h4>Nom: <?= e($a->getFirstname()) ?> </h4>
    <h4>Prénom: <?= e($a->getLastname()) ?> </h4>
    <h4>Email: <?= e($a->getEmail()) ?> </h4>

    <h4>
        <a class="btn btn-link" href="<?= loc('account', 'update', ['account' => $a->getId()]) ?>">Modifier données utilisateur</a>
    </h4>

<?php endif; ?>
