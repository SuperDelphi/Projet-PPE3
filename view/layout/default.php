<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo isset($title_for_layout) ? $title_for_layout : ""; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_SITE . DS . 'css/footer.css' ?>">
    <link rel="stylesheet" href='<?php echo BASE_SITE . DS . '/bootstrap/css/bootstrap.css' ?>' rel="stylesheet">
</head>

<body>
    <header>
        <h1>T2T</h1>
    </header>
    <section>
        <?= $content_for_layout ?>
    </section>
</body>

<!-- Footer -->
<div class="footer">
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

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="link">Plan du site</a>
                        </li>
                        <li>
                            <a href="#!" class="link">Contact</a>
                        </li>
                        <li>
                            <a href="#!" class="link">F.A.Q</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Mentions légales</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="link">C.G.U</a>
                        </li>
                        <li>
                            <a href="#!" class="link">Politique de confidentialité</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase" style="text-align:right;">L'UFOLEP 17 </h5>
                    <p style="text-align:right;">Résidence Club La Fayette, Avenue de Bourgogne 17401 La Rochelle (CEDEX 01)
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