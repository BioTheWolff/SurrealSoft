<?php
$rvar_extra_users = $rvar_extra_users ?? [];
?>

<?php if(empty($rvar_extra_users)): ?>
    <div>No users to display!</div>
<?php else: ?>
    <ul>
        <?php foreach ($rvar_extra_users as $user): /** @var Account $user */ ?>
            <li><?= e($user->getFirstname()) ?> <?= strtoupper(e($user->getLastname())) ?> (email: <?= e($user->getEmail()) ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
