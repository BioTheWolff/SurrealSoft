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
    <title><?= $rvar_page_title ?></title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <button id="catalogue" class="menu" onclick="openPage()">Catalogue</button>
                    <button id="panier" class="menu" onclick="openPage()">Panier</button>
                    <button id="contact" class="menu" onclick="openPage()">Contact</button>
                    <button id="profil" class="menu" onclick="openPage()">Profil</button>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php require_once Path::view($rvar_load_content) ?>
    </main>

    <footer>
        <p style="border: 1px solid black;text-align:right;padding-right:1em;">
            Site réalisé par S.ROBERT - N.TARBOURIECH - F.ZOCCOLA
        </p>
    </footer>
</body>
</html>