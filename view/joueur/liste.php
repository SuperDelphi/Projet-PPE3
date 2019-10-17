<section >
    <form method="post" action="<?= BASE_URL ?>/joueur/supprimer">
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Age</th>
                    <th>Mail</th>
                    <th>Adresse</th>
                    <th>Nom du Club</th>
                    <th>Licence</th>

                </tr>
            </thead>
            <?php foreach ($joueurs as $j) : ?>
                <tr>
                    <td><a href="<?php echo BASE_URL . '/joueur/detail/' . $j->nom; ?>" 
                           title="Cliquez pour modifier"><?= $j->nom ?></a></td>
                    <td> <?= $j->prenom ?></td>
                    <td><?= $j->age ?></td>
                    <td><?= $j->mail ?></td>
                    <td><?= $j->adresse ?></td>
                    <td><?= $j->nomEquipe ?></td>
                    <td><?= $j->licenceJoueur ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </form>
</section>