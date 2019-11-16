<h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . ' ' . $championnat->nomDivision; ?></h2>
<div>
<?php
$cpt = 0;
$cptP = 0;
if (!empty($poules)) {
    echo '<div style="width:45%"><h3>
    <a href="' . BASE_URL . '/rencontre/listeEquipePoule/'.$championnat->idChampionnat.'-'.$poules[$cptP]->nomPoule.'">Poule ' . $poules[$cptP]->nomPoule . '</h3><h6>(Voir les équipes)</a></h6>';
}
foreach ($journee as $j) :
    if ($cpt >= 10) {
    $cpt = 0;
    $cptP++;
    echo '<div><h3>
    <a href="' . BASE_URL . '/rencontre/listeEquipePoule/'.$championnat->idChampionnat.'-'.$poules[$cptP]->nomPoule.'">Poule ' . $poules[$cptP]->nomPoule . '</h3><h6>(Voir les équipes)</a></h6>';

}
$cpt++;
foreach ($j as $rencontre) :
    if ($rencontre > 0 && $rencontre < 100) { ?>
    <div>
        <table border='1' style='text-align:center;width: 100%'>
<?php 
} else {
    if (gettype($rencontre) == "string") { ?>
        <thead>
            <th colspan="5">J<?= $cpt . '<br>' . $rencontre ?></th>
        </thead>
<?php 
} else {
    if ($rencontre < 1 && $rencontre > 100) {
    } else { //var_dump($rencontre);
        foreach ($rencontre as $r) : ?>
                <tr>
                    <td style='width:40%'><a href="<?php echo BASE_URL . '/rencontre/detail/' . $r->idRencontre; ?>">
                    <?php foreach ($equipes as $e) {
                        if ($e->idEquipe == $r->idEquipeA) {
                            echo $e->nomEquipe;
                        }
                    } ?></a></td>
                    <td style='width:5%'> <?= isset($r->scoreFinalA) ? $r->scoreFinalA : '?' ?> </td>
                    <td style='width:5%'> - </td>
                    <td style='width:5%'> <?= isset($r->scoreFinalB) ? $r->scoreFinalB : '?' ?> </td>
                    <td style='width:40%'>
                    <?php foreach ($equipes as $e) {
                        if ($e->idEquipe == $r->idEquipeB) {
                            echo $e->nomEquipe;
                        }
                    } ?> </td>

                </tr> <?php endforeach; ?>
            </table>
        </div>
        <br>
        <br>
                <?php 
            }
        }
    }
    endforeach;
    endforeach;
    ?>
</div>