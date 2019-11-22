<!DOCTYPE html>

<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset=UTF-8">
    <title><?= isset($title_for_layout) ? $title_for_layout : "Tennis de table 17"; ?></title>
    <link rel="icon" href="<?= BASE_SITE . DS . "img/favicon.ico" ?>" type="image/x-icon"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= BASE_SITE . DS . 'css/fonts.css' ?>">
    <link rel="stylesheet" href="<?= BASE_SITE . DS . 'css/main.css' ?>">
    <link rel="stylesheet" href="<?= BASE_SITE . DS . 'css/header.css' ?>">
    <link rel="stylesheet" href="<?= BASE_SITE . DS . 'css/footer.css' ?>">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand link" href="<?= BASE_URL; ?>">
            <img id="logo" src="<?= BASE_SITE . DS . "img/logo_site.png" ?>" alt="Logo de l'UFOLEP">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav" style="padding-right:50px;">
                    <li class="nav-item active">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "championnat/liste"; ?>">Championnats<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "classement/liste"; ?>">Classement des équipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "joueur/listeGenerale"; ?>">Classement des joueurs</a>
                    </li>
                </ul>
                <input id="search-bar" class="mr-sm-2" type="search" placeholder="Rechercher une équipe ou un joueur..."
                       aria-label="Search">
            </form>

            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link link"
                       href="<?= $_SESSION ? BASE_URL . DS . "admin/listeChampionnat" : BASE_URL . DS . "auth/login"; ?>">
                        <?= $_SESSION ? "Mon espace" : "Connexion"; ?></a>
                </li>
            </ul>
            
    </nav>
</header>
<section id="main-section" class="container-fluid">
    <?= $content_for_layout ?>
</section>

<!-- Footer -->
<?php require_once ROOT . DS . "view/layout/footer.php" ?>
<!-- Footer -->

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>