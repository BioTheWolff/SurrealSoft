<?php

/** @var Order $o */
$o = $rvar_extra_order ?? null;
?>

<div>
    <h2>ORDER ID #<?= $o->getId() ?></h2>

    <p>Montant: <?= $o->getAmount() ?> euros</p>
    <p>Date: <?= $o->getDate() ?></p>
    <p>ID Client: <?= $o->getClientId() ?></p>

</div>
