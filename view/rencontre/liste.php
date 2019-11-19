 <div  style="text-align:center">
    <h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . '<br>' . $championnat->nomDivision; ?></h2>
</div>
<br>
<div>
    <?php
    $cpt = 0;
    $cptP = 0;
    $div = 0;
    if (!empty($poules)) {
        echo '<div style="text-align:center"><h3>
    <a href="' . BASE_URL . '/rencontre/listeEquipePoule/' . $championnat->idChampionnat . '-' . $poules[$cptP]->nomPoule . '">Poule ' . $poules[$cptP]->nomPoule . '</h3><h6>(Voir les équipes)</a></h6></div><div>';
    }
    foreach ($journee as $j) :
        if ($cpt >= 10) {
            $cpt = 0;
            $cptP++;
            echo '</div><br><div style="text-align:center"><h3>
    <a href="' . BASE_URL . '/rencontre/listeEquipePoule/' . $championnat->idChampionnat . '-' . $poules[$cptP]->nomPoule . '">Poule ' . $poules[$cptP]->nomPoule . '</h3><h6>(Voir les équipes)</a></h6></div><div>';
        }

        $div++;
        if ($div == 1) {
            echo '<div style="display: inline-block;width:50%"><div>';
        }
        $cpt++;

        foreach ($j as $rencontre) :
            if ($rencontre > 0 && $rencontre < 100) {
                if ($div == 2) {
                    echo '<div style="display: inline-block;width:50%"><div>';
                }
                ?>
                <table border='1' style='text-align:center' class="data-table">
                    <?php
                } else {
                    if (gettype($rencontre) == "string") {
                        ?>
                        <thead>
                        <th colspan="5">J<?= $cpt . '<br>' . $rencontre ?></th>
                        </thead>
                        <?php
                    } else {
                        if ($rencontre < 1 && $rencontre > 100) {
                            
                        } else {
                            foreach ($rencontre as $r) :
                                ?>
                                <tr>
                                    <td style='width:40%'><a href="<?php echo BASE_URL . '/rencontre/detail/' . $r->idRencontre; ?>">
                                            <?php
                                            foreach ($equipes as $e) {
                                                if ($e->idEquipe == $r->idEquipeA) {
                                                    echo $e->nomEquipe;
                                                }
                                            }
                                            ?></a></td>
                                    <td style='width:5%'> <?= isset($r->scoreFinalA) ? $r->scoreFinalA : '?' ?> </td>
                                    <td style='width:5%'> - </td>
                                    <td style='width:5%'> <?= isset($r->scoreFinalB) ? $r->scoreFinalB : '?' ?> </td>
                                    <td style='width:40%'>
                                        <?php
                                        foreach ($equipes as $e) {
                                            if ($e->idEquipe == $r->idEquipeB) {
                                                echo $e->nomEquipe;
                                            }
                                        }
                                        ?> </td>

                                </tr> <?php endforeach; ?>
                        </table>
                        <?php
                    }
                }
            }
            if ($div == 2) {
                echo '</div></div>';
                $div = 0;
            }
            echo '</div>';
        endforeach;
        echo'</div>';
    endforeach;
    echo '</div>';
    