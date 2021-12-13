<?php

/** @var Order $o */
$o = $rvar_extra_order ?? null;

$rvar_extra_products = $rvar_extra_products ?? [];
?>

<div>
    <h2>ORDER ID #<?= $o->getId() ?></h2>

    <p>Montant: <?= $o->getAmount() ?> euros</p>
    <p>Date: <?= $o->getDate() ?></p>
    <p>ID Client: <?= $o->getClientId() ?></p>
    <?php foreach ($rvar_extra_products as $product) : /** @var Product $product */ ?>
        <li><a href="?controller=product&action=read&product=<?= re($product->getSlug()) ?>"><?= e($product->getName()) ?></a> | <?= e($product->getPrice()) ?>€</li>
    <?php endforeach; ?>

</div>
