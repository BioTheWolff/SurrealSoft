<?php
$rvar_extra_products = $rvar_extra_products ?? [];
?>

<?php if(Session::is_admin()): ?>
<a href="<?= loc($rvar_cn ?? null, 'create') ?>">Ajouter un produit</a>
<?php endif; ?>

<?php if(empty($rvar_extra_products)): ?>
    <div>No products to display!</div>
<?php else: ?>
    <h2>Liste des produits:</h2>
    <ul>
        <?php foreach ($rvar_extra_products as $product): /** @var Product $product */ ?>
            <li><a href="?controller=product&action=read&product=<?= re($product->getSlug()) ?>"><?= e($product->getName()) ?></a> | <?= e($product->getPrice()) ?>€</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
