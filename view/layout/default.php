<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ""; ?></title>
        <link href='<?php echo BASE_SITE . DS . '/css/style.css' ?>' rel="stylesheet">
    </head>
    <body class="container">


        <header  >
            <div class="row hidden-xs" id="header_img"></div>
            <h1 class="row">BTS SIO Gestion des Tournois</h1>
        </header>

        <ul class="nav navbar-nav">
            <li class="active" ><a href="<?= BASE_URL ?>/tournoi/liste">Accueil</a></li>
            <li><a href="<?= BASE_URL ?>/tournoi/nouveau">Nouveau tournoi</a></li>
            <li><a href="<?= BASE_URL ?>/jeu/liste">Liste des jeux</a></li>

        </ul>

        <section class="col-lg-10">
            <?= $content_for_layout ?>
        </section>

        <script type="text/javascript">
            $(function () {
                $('#liste_tournoi').dataTable();
            });
        </script>

    </body>
</html>
