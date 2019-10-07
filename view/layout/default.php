<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ""; ?></title>
    </head>
    <body>
        <?= $content_for_layout ?>
    </body>
</html>
