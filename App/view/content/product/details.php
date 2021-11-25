<?php

/** @var Product $p */
$p = $rvar_extra_product ?? null;
?>
<link rel="stylesheet" href="./assets/css/product.css">

<?php if(empty($p)): ?>
    <div class="no-content">Ce produit n'existe pas.</div>
<?php else: ?>

<div class="position">
    <a href="?controller=product">Produits</a> > <?= $p->getName() ?>
</div>
<div class="prd">
    <div class="cover">
        <?php if (!is_null($p->getCover())): ?>
            <img src="data:image/png;base64,<?= $p->getCover() ?>" alt="Image de couverture du produit <?= $p->getName() ?>">
        <?php endif; ?>
    </div>

    <div class="info">
        <div class="box">
            <h2><?= $p->getName() ?></h2>
            <h4 style="color: var(--btn-color);"><?= $p->getPrice() ?> €</h4>

            <p><?= $p->getDescription() ?? 'Aucune description pour ce produit.' ?></p>
            <a class="btn btn-primary" href="<?= loc('cart', 'add', ['product' => $p->getId()]) ?>">Ajouter au panier</a>

            <?php if(Session::is_admin()): ?>
                <a class="btn btn-link" href="<?= loc('product', 'update', ['product' => $p->getSlug()]) ?>">Éditer le produit</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>
