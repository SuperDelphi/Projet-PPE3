<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ""; ?></title>
    </head>
    <body>
        <header>
            <h1>T2T</h1>
        </header>
        <section>
            <?= $content_for_layout ?>
        </section>
    </body>
</html>
