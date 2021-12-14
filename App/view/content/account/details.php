<?php

/** @var Account $a */
$a = $rvar_extra_account ?? null;

$suppr = Session::is_admin() && Session::get('id') != $a->getId() ? "Supprimer l'utilisateur" : "Supprimer mon compte"
?>

<?php if (Session::is_admin()): ?>
    <a class="btn btn-link" href="<?= loc("account", "readAll") ?>">Voir tous les utilisateurs</a>
<?php endif; ?>

<?php if(empty($a)): ?>

    <div class="no-content">Aucun compte trouvé sous cet identifiant.</div>

<?php else: ?>
    <div class="account-details">
    <?php if(Session::is_admin() && Session::get('id') != $a->getId()): ?>
        <h2>Compte n°<?= $a->getId() ?></h2>
    <?php else: ?>
        <h2>Votre compte:</h2>
    <?php endif; ?>

    <h4>Nom: <?= e($a->getFirstname()) ?> </h4>
    <h4>Prénom: <?= e($a->getLastname()) ?> </h4>
    <h4>Email: <?= e($a->getEmail()) ?> </h4>

    </div>

    <h4>
        <a class="btn btn-link" href="<?= loc('account', 'update', ['account' => $a->getId()]) ?>">Modifier données utilisateur</a>
    </h4>

    <div>
        <a class="btn btn-link" href="<?= loc('order', 'readAll', ['account' => $a->getId()]) ?>">Voir mes commandes</a>
    </div>

    <a href="<?= loc('account', 'delete', ['account' => $a->getId()]) ?>" class="btn btn-error"><?= $suppr ?></a>

<?php endif; ?>
