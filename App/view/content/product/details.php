<?php

/** @var Product $p */
$p = $rvar_extra_product ?? null;
?>

<div>
    <h2><?= $p->getName() ?></h2>
    <h4><?= $p->getPrice() ?> €</h4>

    <p><?= $p->getDescription() ?? 'Aucune description pour ce produit.' ?></p>
    
    <?php if (!is_null($p->getCover())): ?>
        <div>
            <img src="data:image/png;base64,<?= $p->getCover() ?>" alt="Image de couverture du produit <?= $p->getName() ?>">
        </div>
    <?php endif; ?>

    <div>
        <a href="<?= loc('cart', 'add', ['product' => $p->getId()]) ?>">Ajouter au panier</a>

        <?php if(Session::is_admin()): ?>
            <a href="<?= loc('product', 'update', ['product' => $p->getSlug()]) ?>">Éditer le produit</a>
        <?php endif; ?>
    </div>
</div>
