<div>
    <h2><?= $rencontre[0]->nomChampionnat . ' ' . $rencontre[0]->typeChampionnat ?></h2>
    <h3><?php
        foreach ($divisions as $d) {
            if ($d->idDivision == $rencontre[0]->idDivision) {
                echo $d->nomDivision;
            }
        }
    ?>
    | Poule <?= $rencontre[0]->nomPoule ?> | J.N°<?= $rencontre[0]->numJournee ?></h3>
</div>
<div>
    <p>Date : <?= $rencontre[0]->date ?> | Heure : <?= $rencontre[0]->heure ?> | Lieu : <?= $rencontre[0]->lieu ?></p>
    <p>Nom et adresse du Juge Arbitre : 
    <?php foreach ($joueurs as $j) {
        if ($j->idJoueur == $rencontre[0]->idArbitre) {
            echo $j->nom . ' ' . $j->prenom;
        }
    } ?>
    </p>
</div>
<div>
    <table style='text-align:center' border='1'>
        <thead>
            <th></th>
            <th>Noms</th>
            <th>Noms</th>
            <th>Score 1</th>
            <th>Score 2</th>
            <th>Score 3</th>
            <th>Score 4</th>
            <th>Score 5</th>
            <th>Points ABC</th>
            <th>Points XYZ</th>
        </thead>
        <?php foreach ($matchs as $match) : ?>
            <tr>
                <td></td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJoueurA) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJoueurB) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td><?= $match->score1A . ' / ' . $match->score1B ?></td>
                <td><?= $match->score2A . ' / ' . $match->score2B ?></td>
                <td><?= $match->score3A . ' / ' . $match->score3B ?></td>
                <td><?= isset($match->score4A) ? $match->score4A . ' / ' . $match->score4B : '-'; ?></td>
                <td><?= isset($match->score5A) ? $match->score5A . ' / ' . $match->score5B : '-'; ?></td>
                <td><?= ($match->pointsA == 1) ? $match->pointsA : '-'; ?></td>
                <td><?= ($match->pointsB == 1) ? $match->pointsB : '-'; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8">Score de le rencontre</td>
            <td><?= $rencontre[0]->scoreFinalA ?></td>
            <td><?= $rencontre[0]->scoreFinalB ?></td>
        </tr>
    </table>
</div>
<br>
<div>
    <p>
        RESULTATS : Victoire : Equipe : <?php ($rencontre[0]->scoreFinalA < $rencontre[0]->scoreFinalB) ? 
        $idEquipe = $rencontre[0]->idEquipeA : $idEquipe = $rencontre[0]->idEquipeB;
        foreach ($equipes as $e) {
            if ($e->idEquipe == $idEquipe) {
                echo $e->nomEquipe;
            }
        }
         ?>
        <?= ($rencontre[0]->scoreFinalA == $rencontre[0]->scoreFinalB) ? '| Match Nul' : ''; ?>
    </p>
</div>