<h2><?= $championnat->nomChampionnat.'<br>'. $championnat->typeChampionnat.'<br>'.$championnat->nomDivision;?></h2>
<?php $cpt = 0; foreach ($journee as $j) : 
    $cpt++;
        foreach ($j as $rencontre) : 
        if (gettype($rencontre) == "string") { ?>

        <div style=''>
            <table border='1' style='text-align:center;width: 30%'>
                <thead>
                    <th colspan="5">J<?= $cpt. '<br>' . $rencontre ?></th>
                </thead>

                <?php 
                } else {
                foreach ($rencontre as $r) : ?>

                <tr>
                    <td style='width:40%'>
                    <?php foreach ($equipes as $e) {
                        if ($e->idEquipe == $r->idEquipeA) {
                            echo $e->nomEquipe;
                        }
                    } ?></td>
                    <td style='width:5%'> <?= isset($r->scoreFinalA) ? $j->scoreFinalA : '?' ?> </td>
                    <td style='width:5%'> - </td>
                    <td style='width:5%'> <?= isset($r->scoreFinalB) ? $j->scoreFinalB : '?' ?> </td>
                    <td style='width:40%'>
                    <?php foreach ($equipes as $e) {
                        if ($e->idEquipe == $r->idEquipeB) {
                            echo $e->nomEquipe;
                        }
                    } ?> </td>

                </tr> <?php endforeach; ?>
            </table>
        </div>

                <?php }
        endforeach;
    endforeach;