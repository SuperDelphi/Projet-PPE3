<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>
<div>
    <h1><?= $rencontre[0]->nomChampionnat . ' ' . $rencontre[0]->typeChampionnat ?></h1>
    <h3><?php
        foreach ($divisions as $d) {
            if ($d->idDivision == $rencontre[0]->idDivision) {
                echo $d->nomDivision;
            }
        }
        ?>
    | Poule <?= $nomPoule ?> | J.N° <?= $rencontre[0]->numJournee ?></h3>
</div>
<div>
    <table border=1 class="data-table sober">
        <tr>
            <td>Date : <?= $rencontre[0]->date ?></td>
            <td>Heure : <?= $rencontre[0]->heure ?></td>
            <td>Lieu : <?= $rencontre[0]->lieu ?></td>
        </tr>
        <tr>
            <td colspan="3">Nom et adresse du Juge Arbitre : 
    <?php foreach ($joueurs as $j) {
        if ($j->idJoueur == $rencontre[0]->idArbitre) {
            echo $j->nom . ' ' . $j->prenom;
        }
    } ?></td>
        </tr>
    </table>
</div>
<br>
<div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
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
                <th>Classement</th>
                <th></th>
                <th>NOMS PRENOMS</th>
                <th>Licence</th>
                <th>Classement</th>
            </tr>
        </thead>
        <tr>
        <?php for ($cpt = 0; $cpt < 3; $cpt++) : ?>
            <td><?php if ($cpt == 0) {
                    echo 'A';
                } elseif ($cpt == 1) {
                    echo 'B';
                } else {
                    echo 'C';
                } ?></td>
            <?php foreach ($joueurs as $j) {
                if ($j->idJoueur == $matchs[$cpt]->idJoueurA) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . $j->licenceJoueur . '</td>';
                    echo '<td>' . $j->scoreGlobale . '</td>';
                }
            } ?>
            <td><?php if ($cpt == 0) {
                    echo 'X';
                } elseif ($cpt == 1) {
                    echo 'Y';
                } else {
                    echo 'Z';
                } ?></td>
            <?php foreach ($joueurs as $j) {
                if ($j->idJoueur == $matchs[$cpt]->idJoueurB) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . $j->licenceJoueur . '</td>';
                    echo '<td>' . $j->scoreGlobale . '</td>';
                }
            } ?>
        </tr>
            <?php endfor; ?>
    </table>
</div>
<br>
<div>
    <table border='1'class="data-table sober">
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
    <table border=1 class="data-table sober">
        <thead  class="text-center">
            <th colspan=3>Résultats</th>
        </thead>
    <?php ($rencontre[0]->scoreFinalA < $rencontre[0]->scoreFinalB) ?
            $idEquipe = $rencontre[0]->idEquipeB : $idEquipe = $rencontre[0]->idEquipeA; ?>
    <tbody>
        <tr>
            <?php  if($rencontre[0]->scoreFinalA == $rencontre[0]->scoreFinalB) {
            echo "<td>Match Nul</td>";
            } else {?>
                <td>Victoire de l'équipe : </td>
                <td>
                    <?php
                    foreach ($equipes as $e) {
                        if ($e->idEquipe == $idEquipe) {
                            echo $e->nomEquipe;
                        }
                    }
                    ?>
                </td>
            <?php } ?>
        </tr>
        <tr>
            <td>Score : </td>
            <td><?php if ($rencontre[0]->scoreFinalA > $rencontre[0]->scoreFinalB) 
            {echo $rencontre[0]->scoreFinalA . ' / ' . $rencontre[0]->scoreFinalB;}
            else {echo $rencontre[0]->scoreFinalB . ' / ' . $rencontre[0]->scoreFinalA;} ?></td>
        </tr>
        
    </tbody>
    </table>
</div>
<br>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>