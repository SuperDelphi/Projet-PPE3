<section>
    <h2>Classement des joueurs</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Joueurs</th>
                    <th>Score</th>
                    <th><input class="primarybuttonBlue" type="button" value="Simuler" onClick="self.location.href='<?= BASE_URL . DS ?>/simulationJoueur/formSimulation'"/></th>
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
</section>