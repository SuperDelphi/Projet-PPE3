<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <h2>Classement des équipes</h2>
    <hr>

    <table class="data-table">
        <thead>
            <tr>
                <th>Place</th>
                <th>Équipes</th>
                <th>Score</th>
            </tr>
        </thead>
        <?php $place = 1; foreach ($classement as $c) : ?>
            <tr>
                <td><?= $place++ ?></td>
                <td><?= $c->nomEquipe ?></td>
                <td><?= $c->scoreGlobal ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>