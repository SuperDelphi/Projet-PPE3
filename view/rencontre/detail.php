<div>
    <h2><?= $rencontre[0]->nomChampionnat . ' ' . $rencontre[0]->typeChampionnat ?></h2>
    <h3><?php
        foreach ($divisions as $d) {
            if ($d->idDivision == $rencontre[0]->idDivision) {
                echo $d->nomDivision;
            }
        }
        ?>
    | Poule <?= $nomPoule ?> | J.N°<?= $rencontre[0]->numJournee ?></h3>
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
    <table style='text-align:center' border='1' class="data-table">
        <thead>
            <tr>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeA) {
                                            echo $e->nomEquipe;
                                        }
                                    }
                                    ?></th>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeB) {
                                            echo $e->nomEquipe;
                                        }
                                    }
                                    ?></th>
            </tr>
            <tr>
                <th></th>
                <th>NOMS PRENOMS</th>
                <th>Licence</th>
                <th>Class</th>
                <th></th>
                <th>NOMS PRENOMS</th>
                <th>Licence</th>
                <th>Class</th>
            </tr>
        </thead>
        <tr>
        <?php for($cpt = 0; $cpt < 3; $cpt++) : ?>
            <td><?php if($cpt == 0) {echo 'A';} elseif ($cpt == 1) {echo 'B';} else {echo 'C';} ?></td>
            <?php foreach ($joueurs as $j) {
                    if ($j->idJoueur == $matchs[$cpt]->idJoueurA) {
                        echo '<td>'.$j->nom.' '.$j->prenom.'</td>';
                        echo '<td>'.$j->licenceJoueur.'</td>';
                        echo '<td>'.$j->scoreGlobale.'</td>';
                    }
                } ?>
            <td><?php if($cpt == 0) {echo 'X';} elseif ($cpt == 1) {echo 'Y';} else {echo 'Z';} ?></td>
            <?php foreach ($joueurs as $j) {
                    if ($j->idJoueur == $matchs[$cpt]->idJoueurB) {
                        echo '<td>'.$j->nom.' '.$j->prenom.'</td>';
                        echo '<td>'.$j->licenceJoueur.'</td>';
                        echo '<td>'.$j->scoreGlobale.'</td>';
                    }
                } ?>
        </tr>
            <?php endfor; ?>
    </table>
</div>
<br>
<div>
    <table style='text-align:center' border='1'class="data-table">
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
        <?php $cpt = 0;
        foreach ($matchs as $match) : ?>
            <tr>
                <td><?= $typeRencontre[$cpt];
                    $cpt++ ?></td>
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
        RESULTATS : <br>Victoire : <br>Equipe : 
        <?php ($rencontre[0]->scoreFinalA < $rencontre[0]->scoreFinalB) ?
            $idEquipe = $rencontre[0]->idEquipeB : $idEquipe = $rencontre[0]->idEquipeA;
        foreach ($equipes as $e) {
            if ($e->idEquipe == $idEquipe) {
                echo $e->nomEquipe;
                echo '<br>Score : ' . $rencontre[0]->scoreFinalA . '/' . $rencontre[0]->scoreFinalB;
            }
        }
        ?>
        <?= ($rencontre[0]->scoreFinalA == $rencontre[0]->scoreFinalB) ? '| Match Nul' : ''; ?>
    </p>
</div>