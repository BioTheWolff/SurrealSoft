<?php
$rvar_extra_users = $rvar_extra_users ?? [];
?>

<?php if(empty($rvar_extra_users)): ?>
    <div>No users to display!</div>
<?php else: ?>
    <?php foreach ($rvar_extra_users as $account): /** @var Account $account */ ?>
    <div class="product">
        <a href="<?= loc('account', 'read', ['account' => re($account->getEmail())]) ?>"><?= e($account->getFirstname()) ?> <?= strtoupper(e($account->getLastname())) ?> (email: <?= e($account->getEmail()) ?>)</a>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
