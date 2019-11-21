<div  style="text-align:center">
    <h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . '<br>' . $championnat->nomDivision; ?></h2>
</div>
<br>
<?php
$cpt = 1;
$idJournee = $rencontres[0]['idJournee'];
?>

<div style="text-align:center">
    <h3><a href="<?= BASE_URL ?>/rencontre/listeEquipePoule/<?= $championnat->idChampionnat . '-' . $nomPoule ?>">Poule <?= $nomPoule ?></h3><h6>(Voir les équipes)</a></h6>
</div>
<div>
    <table border='1' style="width:50%" class="data-table">
        <thead style="text-align:center">
        <th colspan="5">J<?= $cpt++ . '<br>' . $rencontres[0][0]['rencontre']->datePrev ?></th>
        </thead>
        <tbody>
            <?php
            foreach ($rencontres as $r) :
                //var_dump($r);
                if ($r[0]['rencontre']->idJournee == $idJournee) {
                    ?>
                    <tr>
                        <td style='width:40%'><a href="<?php echo BASE_URL . '/rencontre/detail/' . $r[0]['rencontre']->idRencontre ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                        echo $e->nomEquipe;
                                    }
                                }
                                ?></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                        <td style='width:5%'> - </td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                        <td style='width:40%'>
                            <?php
                            foreach ($equipes as $e) {
                                if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                    echo $e->nomEquipe;
                                }
                            }
                            ?> </td>
                    </tr>
    <?php } else { ?>
                </tbody>
            </table>
            <br>
            <table border='1' style="width:50%" class="data-table">
                <thead style="text-align:center">
                <th colspan="5">J<?= $cpt++ . '<br>' . $r[0]['rencontre']->datePrev ?></th>
                </thead>
                <tbody>
                    <tr>
                        <td style='width:40%'><a href="<?php echo BASE_URL . '/rencontre/detail/' . $r[0]['rencontre']->idRencontre ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                        echo $e->nomEquipe;
                                    }
                                }
                                ?></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                        <td style='width:5%'> - </td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                        <td style='width:40%'>
                            <?php
                            foreach ($equipes as $e) {
                                if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                    echo $e->nomEquipe;
                                }
                            }
                            ?> </td>
                    </tr>
                <?php $idJournee = $r[0]['rencontre']->idJournee;
                }
            endforeach;
            ?>
        </tbody>
    </table>
</div>
