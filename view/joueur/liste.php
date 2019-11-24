<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <h2>Classement général</h2>
    <hr>

    <a href="<?= BASE_URL . DS . "/simulationJoueur/formSimulation" ?>" class="button primarybuttonBlue">
        <i class="fas fa-sort-amount-up-alt"></i>
        &nbspFaire une simulation
    </a>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Joueurs</th>
                    <th>Score</th>
                    <th></th>
                </tr>
            </thead>
            <?php $place = 1; foreach ($joueurs as $j) : ?>
                <tr>
                    <td><?= $place++ ?></td>
                    <td><a href="<?php echo BASE_URL . '/joueur/detail/' . $j->idJoueur; ?>" 
                           title="Cliquez pour modifier"><?= $j->nom . ' '. $j->prenom ?></a></td>
                    <td><?= $j->scoreGlobale ?></td>
                </tr>

            <?php endforeach; ?>
        </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>