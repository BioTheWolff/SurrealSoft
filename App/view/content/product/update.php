
<?php

if (${v('is_update')} ?? false) $p = ${v('product')};
else $p = new Product(true);
/** @var Product $p */

?>

<form method="post" action="<?= loc($rvar_cn ?? null, ${v('form_action')} ?? null) ?>" enctype="multipart/form-data">
    <fieldset>
        <legend>Description basique du produit</legend>

        <label>
            Nom du produit
            <input type="text" name="name" value="<?= $p->getName() ?? ${v('name')} ?? '' ?>" required>
        </label>

        <label>
            Slug du produit
            <input type="text" name="slug" value="<?= $p->getSlug() ?? ${v('slug')} ?? '' ?>" <?= reqred(${v('is_update')} ?? false) ?>>
        </label>

        <label>
            Description du produit
            <input type="text" name="description" value="<?= $p->getDescription() ?? ${v('description')} ?? '' ?>">
        </label>

        <label>
            Prix du produit
            <input type="text" name="price" value="<?= $p->getPrice() ?? ${v('price')} ?? 0 ?>">
        </label>
    </fieldset>

    <fieldset>
        <legend>Image du produit</legend>

        <label>
            Image de couverture
            <input type="file" accept="image/png" name="cover">
        </label>

        <?php if ($p->getCover() ?? ${v('cover')} ?? false): ?>
        <div>
            <p>Image actuelle:</p>
            <img src="data:image/png;base64,<?= $p->getCover() ?? ${v('cover')} ?>" alt="Image actuelle du produit">
            <input hidden type="text" name="cover_save" value="<?= $p->getCover() ?? ${v('cover')} ?? '' ?>">
        </div>
        <?php endif; ?>
    </fieldset>


    <input type="submit" value="<?= ${v('is_update')} ?? false ? "Mettre à jour" : "Ajouter" ?> le produit">
</form>