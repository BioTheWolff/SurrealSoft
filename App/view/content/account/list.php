<?php
$rvar_extra_users = $rvar_extra_users ?? [];
?>

<h2>Liste des utilisateurs</h2>

<?php if(empty($rvar_extra_users)): ?>
    <div>No users to display!</div>
<?php else: ?>
    <?php foreach ($rvar_extra_users as $account): /** @var Account $account */ ?>
    <div class="account">
        <a href="<?= loc('account', 'read', ['account' => re($account->getId())]) ?>"><?= e($account->getFirstname()) ?> <?= strtoupper(e($account->getLastname())) ?> (email: <?= e($account->getEmail()) ?>)</a>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
