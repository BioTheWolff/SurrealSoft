<?php
$rvar_extra_users = $rvar_extra_users ?? [];
?>

<h2>Liste des utilisateurs</h2>

<?php if(empty($rvar_extra_users)): ?>
    <div>No users to display!</div>
<?php else: ?>
    <div class="account">
        <?php foreach ($rvar_extra_users as $account): /** @var Account $account */?>

            <a class="btn btn-link" href="<?= loc('account', 'read', ['account' => re($account->getId())]) ?>">
                <?php if(Session::is_admin() && Session::get('id')): ?>
                    Compte n°<?= $account->getId() ?>:
                <?php endif; ?>
                <br>
                <?= e($account->getFirstname()) ?> <?= strtoupper(e($account->getLastname())) ?> (email: <?= e($account->getEmail()) ?>)</a>

        <?php endforeach; ?>
    </div>
<?php endif; ?>
