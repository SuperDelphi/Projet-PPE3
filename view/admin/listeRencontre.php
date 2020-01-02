<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2><?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat
. " " . $championnat->nomDivision ?> : Liste des rencontres</h2>
<hr>
<table style='text-align:center' class="data-table sober">
<?php
$cpt = 0;
foreach ($rencontre as $r) :
    ?>
        <tr>
            <td style='width:30%'>
                    <?php
                        foreach ($equipes as $e) {
                            if ($e[0]->idEquipe === $r->idEquipeA) {
                                echo $e[0]->nomEquipe;
                                break;
                            }
                        }
                        ?></td>
            <td style='width:5%'> <?= isset($r->scoreFinalA) ? $r->scoreFinalA : '?' ?> </td>
            <td style='width:5%'> - </td>
            <td style='width:5%'> <?= isset($r->scoreFinalB) ? $r->scoreFinalB : '?' ?> </td>
            <td style='width:30%'>
                <?php
                    foreach ($equipes as $e) {
                        if ($e[0]->idEquipe === $r->idEquipeB) {
                            echo $e[0]->nomEquipe;
                            break;
                        }
                    }
                    ?></td>
            <td style='width:5%'>
                <a href="<?php echo BASE_URL .
                "/admin/formRencontre/?idRencontre=".$r->idRencontre?>" class="button primarybuttonBlue col-lg text-center">Scores</a>
            </td>
            <td style='width:20%'>
                <a href="" class="button primarybuttonWhite col-lg text-center">Feuille de Match</a>
            </td>
        </tr>
<?php

endforeach;
echo '</table>';
require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";
