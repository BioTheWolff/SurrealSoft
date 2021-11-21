<?php

/** @var Product $p */
$p = $rvar_extra_product ?? null;
?>

<div>
    <h2><?= $p->getName() ?></h2>
    <h4><?= $p->getPrice() ?> €</h4>

    <p><?= $p->getDescription() ?? 'Aucune description pour ce produit.' ?></p>

    <div>
        <a href="?controller=cart&action=add&product=<?= $p->getId() ?>">Ajouter au panier</a>
    </div>
</div>
