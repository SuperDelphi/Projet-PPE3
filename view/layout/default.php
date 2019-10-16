<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ""; ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href='<?php echo BASE_SITE . DS . '/bootstrap/css/bootstrap.css' ?>' rel="stylesheet">

    </head>
    <body>
        <header>
            <!-- <h1>T2T</h1> -->
            <!--Navbar
            <nav class="navbar navbar-expand-sm navbar-dark" style='background-color: #002752'>
                
                <form class="form-inline" action="#">
                    <input class="form-control" type="text" size="25" placeholder="Rechercher un championnat, un joueur etc">
                </form>
            </nav>-->
        </header>
        <section>
            <?= $content_for_layout ?>
        </section>
    </body>
</html>
