<?php
$rvar_load_content = $rvar_load_content ?? '';
$rvar_page_title = $rvar_page_title ?? 'SurrealSoft';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/content.css">

    <title><?= $rvar_page_title ?></title>
</head>
<body>
    <header class="nav">
        <div class="nav-start">
            <a href="./" class="btn btn-link">Accueil</a>
            <a href="?controller=product" class="btn btn-link">Produits</a>
        </div>

        <div class="nav-brand text-center">
            <a href="./"><div><img src="./assets/img/logo.png" alt="SurrealSoft"></div></a>
        </div>

        <div class="nav-end">
            <a href="?controller=cart" class="btn btn-link">Panier</a>

            <!-- espace de connexion/inscription -->
            <?php if(Session::is_connected()): ?>
                <a href="?action=logout" class="btn btn-link">Se déconnecter</a>
            <?php else: ?>
                <a href="#" class="btn btn-primary">S'inscrire</a>
                <a href="?action=connect" class="btn btn-link">Se connecter</a>
            <?php endif ?>
        </div>
    </header>

    <main>
        <?php require_once Path::view($rvar_load_content) ?>
    </main>

    <footer>
        <div class="text-center">
            Site réalisé par Suzanne R. - Noé T. - Fabien Z.
        </div>
    </footer>
</body>
</html>