<?php

/** @var Account $a */
$a = $rvar_extra_account ?? null;
?>

<?php if(empty($a)): ?>
    <div class="no-content">err compte</div>
<?php else: ?>

<h2>Votre compte:</h2>
<h4>Nom: <?= e($a->getFirstname()) ?> </h4>
<h4>Prénom: <?= e($a->getLastname()) ?> </h4>
<h4>Email: <?= e($a->getEmail()) ?> </h4>

<h4>
    <a class="btn btn-link" href="<?= loc('account', 'update', ['account' => $a->getId()]) ?>">Modifier données utilisateur</a>
</h4>

<?php endif; ?>
