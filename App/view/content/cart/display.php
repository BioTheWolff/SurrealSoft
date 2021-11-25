
<h2>Panier</h2>
<?php if(!Cart::is_empty()): ?>
    <div class="container-cart">
        <div class="container">
        <?php
            $total = 0;
            foreach ($rvar_extra_cart_items ?? [] as $product):
                /** @var CartProduct $product */
                $url_name = re($product->getName());
                $total += $product->getTotalPrice();
        ?>
        <div class="product">
            <div class="product-image">
                <img src="<?= !is_null($product->getCover()) ? "data:image/png;base64,{$product->getCover()}" : "https://via.placeholder.com/150.png?text={$url_name}" ?>" alt="<?= $product->getName() ?>">
            </div>
            <div class="product-description">
                <div class="cart-item">
                    <a href="<?= loc('product', 'read', ['product' => re($product->getSlug())]) ?>" class="btn btn-invisible"><h3><?= $product->getName() ?></h3></a>
                    <h5><?= $product->getQuantity() ?>x</h5>
                </div>
                <div class="content">
                    <div>
                        prix total : <?= $product->getTotalPrice() ?>€
                        <?php if ($product->is_multiple()): ?>
                        <br> prix à l'unité : <?= $product->getPrice() ?>€
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="<?= loc('cart', 'remove', ['product' => re($product->getId())]) ?>" class="btn btn-error">Retirer le produit</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
        <div class="total-cart">
            <h3>Total Panier: </h3>
            <h2><?= $total ?> €</h2>
            <a class="btn btn-primary" href="<?= loc('order', 'create') ?>">Commander</a>
        </div>
    </div>
<?php else: ?>
<div class="no-content text-center">
    <div class="m-10">
        Votre panier est vide pour le moment !<br>
        Pourquoi ne pas aller le remplir ?
    </div>
    <a href="<?= loc('product') ?>" class="btn btn-link">Consulter nos produits</a>
</div>
<?php endif; ?>
