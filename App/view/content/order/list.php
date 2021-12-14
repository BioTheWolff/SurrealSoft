<?php
$rvar_extra_orders = $rvar_extra_orders ?? [];
?>

<?php if (empty($rvar_extra_orders)) : ?>
    <div class="no-content">Aucune commande passée pour le moment !</div>
<?php else : ?>
    <h2>Liste des commandes client</h2>
    <ul>
        <?php foreach ($rvar_extra_orders as $order) : /** @var Order $order */ ?>
            <li><a href="?controller=order&action=read&order=<?= re($order->getId()) ?>">ID #<?= e($order->getId()) ?></a> | <?= e($order->getDate()) ?> | <?= e($order->getAmount()) ?>€</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
