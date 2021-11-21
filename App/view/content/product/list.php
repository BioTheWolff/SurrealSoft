<?php
$rvar_extra_products = $rvar_extra_products ?? [];
?>

<?php if(Session::is_admin()): ?>
<a href="<?= loc($rvar_cn ?? null, 'create') ?>">Ajouter un produit</a>
<?php endif; ?>

<?php if(empty($rvar_extra_products)): ?>
    <div class="no-content">Désolé, mais aucun produit n'est disponible.</div>
<?php else: ?>
    <h2>Produits</h2>
    <?php
        foreach ($rvar_extra_products as $product):
            /** @var Product $product */
            $url_name = re($product->getName());
    ?>
        <div class="product">
            <div class="product-image">
                <img src="<?= !is_null($product->getCover()) ? "data:image/png;base64,{$product->getCover()}" : "https://via.placeholder.com/150.png?text={$url_name}" ?>" alt="<?= $product->getName() ?>">
            </div>
            <div class="product-description">
                <div><h3><?= $product->getName() ?></h3></div>
                <div class="content">
                    <div>
                        <?= $product->getDescription() ?? 'Aucune description pour ce produit.' ?>
                    </div>
                    <div>
                        <a href="<?= loc('product', 'read', ['product' => re($product->getSlug())]) ?>" class="btn btn-primary">Consulter le produit</a>

                        <?php if(Session::is_admin()): ?>
                            <a href="<?= loc('product', 'update', ['product' => re($product->getSlug())]) ?>" class="btn btn-link">Éditer</a>
                            <a href="<?= loc('product', 'delete', ['product' => re($product->getSlug())]) ?>" class="btn btn-error">Supprimer</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
