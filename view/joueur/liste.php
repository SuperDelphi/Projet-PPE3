<section >
    <h2>Classement des joueurs</h2>
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Score</th>

                </tr>
            </thead>
            <?php $place = 1; foreach ($joueurs as $j) : ?>
                <tr>
                    <td><?= $place++ ?></td>
                    <td><a href="<?php echo BASE_URL . '/joueur/detail/' . $j->idJoueur; ?>" 
                           title="Cliquez pour modifier"><?= $j->nom ?></a></td>
                    <td> <?= $j->prenom ?></td>
                    <td><?= $j->scoreGlobal ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
</section>