
<h2>Panier</h2>
<?php if(!Cart::is_empty()): ?>
    <div class=".container">
        <?php
            foreach ($rvar_extra_cart_items ?? [] as $product):
                /** @var CartProduct $product */
                $url_name = re($product->getName());
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
                            <a href="<?= loc('cart', 'remove', ['product' => re($product->getId())]) ?>" class="btn btn-primary">Retirer le produit</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
