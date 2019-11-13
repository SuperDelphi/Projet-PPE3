<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?= isset($title_for_layout) ? $title_for_layout : ""; ?></title>
    <link rel="stylesheet" href='<?= BASE_SITE . DS . 'bootstrap/css/bootstrap.css' ?>'>
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
                    <li class=" nav-item active">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "championnat/liste"; ?>">Championnats<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "classement/liste"; ?>">Classements des équipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="<?= BASE_URL . DS . "joueur/liste"; ?>">Classements des joueurs</a>
                    </li>
                </ul>
                <input id="search-bar" class="form-control mr-sm-2" type="search" placeholder="Recherche championnat, joueur..."
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
<section id="main-section">
    <?= $content_for_layout ?>
</section>
</body>

<!-- Footer -->
<div class="footer-container">
    <footer class="page-footer font-small blue pt-4">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">


                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Liens utiles</h5>

                    <div class="horizontal-sep"></div>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="link footer-text">Plan du site</a>
                        </li>
                        <li>
                            <a href="#!" class="link footer-text">Contact</a>
                        </li>
                        <li>
                            <a href="#!" class="link footer-text">F.A.Q</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Mentions légales</h5>

                    <div class="horizontal-sep"></div>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="link footer-text">C.G.U</a>
                        </li>
                        <li>
                            <a href="#!" class="link footer-text">Politique de confidentialité</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase" style="text-align:right;">L'UFOLEP 17 </h5>

                    <p class="footer-text text-right">Résidence Club La Fayette, Avenue de Bourgogne 17401 La Rochelle (CEDEX
                        01)
                        <br>05 46 41 73 13
                        <br>ufolep-usep@laligue17.org</p>
                    <br>
                </div>
            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->
    </footer>
    <!-- Footer -->
</div>

</html>