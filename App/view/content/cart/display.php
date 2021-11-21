
<?php if(!Cart::is_empty()): ?>
<ul>
    <?php foreach ($rvar_extra_cart_items ?? [] as $p): /** @var CartProduct $p */ ?>
        <li>
            <?= $p->getQuantity() ?>x <?= e($p->getName()) ?> :
            <?= $p->getTotalPrice() ?>€ (<?= $p->getPrice() ?>€ à l'unité)
            [<a href="<?= loc('cart', 'remove', ['product' => $p->getId()]) ?>">Retirer le produit</a>]
        </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<div>
    Panier vide !
</div>
<?php endif; ?>
