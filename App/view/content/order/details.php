<?php

/** @var Order $o */
$o = $rvar_extra_order ?? null;

$rvar_extra_products = $rvar_extra_products ?? [];

$total = function ($p, $q) { return $p * $q; };
?>

<div>
    <h2>ORDER ID #<?= $o->getId() ?></h2>

    <p>Montant total: <?= $o->getAmount() ?>€</p>
    <p>Commande effectuée le <?= date("j/m/Y, à H:i:s", strtotime($o->getDate())) ?></p>
    <?php if (Session::is_admin()): ?>
        <p>ID Client: <?= $o->getClientId() ?></p>
    <?php endif; ?>

</div>

<?php
foreach ($rvar_extra_products as $product) :
    /** @var OrderedProduct $product */
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
                    prix total : <?= $total($product->getPrice(), $product->getQuantity()) ?>€
                    <?php if ($product->getQuantity() > 1): ?>
                        <br> prix à l'unité : <?= $product->getPrice() ?>€
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>