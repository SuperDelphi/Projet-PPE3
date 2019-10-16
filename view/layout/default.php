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

    <h4>Mentions légales</h4>
    <p>Résidence Club La Fayette, Avenue de Bourgogne</p>
    <p>17401 La Rochelle (CEDEX 01)</p>
    <p>05 46 41 73 13</p>
    <p>ufolep-usep@laligue17.org</p>

</footer>

</html>