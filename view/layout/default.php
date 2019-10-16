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
<!--
<footer>
    <h4>Liens utiles</h4>
    <ul>
        <li>Plan du site</li>
        <li>Contact</li>
        <li>F.A.Q</li>
    </ul>

    <h4>Mentions légales</h4>
    <ul>
        <li>C.G.U</li>
        <li>Politique de confidentialité</li>
    </ul>

    <h4>L'UFOLEP 17</h4>
    <p>Résidence Club La Fayette, Avenue de Bourgogne</p>
    <p>17401 La Rochelle (CEDEX 01)</p>
    <p>05 46 41 73 13</p>
    <p>ufolep-usep@laligue17.org</p>

</footer>
-->
<!-- Footer -->
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
                        <a href="#!">Plan du site</a>
                    </li>
                    <li>
                        <a href="#!">Contact</a>
                    </li>
                    <li>
                        <a href="#!">F.A.Q</a>
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
                        <a href="#!">C.G.U</a>
                    </li>
                    <li>
                        <a href="#!">Politique de confidentialité</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->
                <h5 class="text-uppercase">L'UFOLEP 17 </h5>
                <p>Résidence Club La Fayette, Avenue de Bourgogne 17401 La Rochelle (CEDEX 01)
                    <br>05 46 41 73 13
                    <br>ufolep-usep@laligue17.org</p>
                <br><br>
            </div>
        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->
</footer>
<!-- Footer -->

</html>