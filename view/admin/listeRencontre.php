<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2><?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat . " " . $championnat->nomDivision; ?> : Liste des rencontres</h2>
<hr>
<table border='1' style='text-align:center' class="data-table">
<?php
$cpt = 0;
foreach ($rencontre as $r) :
    ?>
        <tr>
            <td style='width:40%'>
                    <?php
                        foreach ($equipes as $e) {
                            if ($e[0]->idEquipe === $r->idEquipeA) {
                                echo $e[0]->nomEquipe;
                            }
                        }
                        ?></td>
            <td style='width:5%'> <?= isset($r->scoreFinalA) ? $r->scoreFinalA : '?' ?> </td>
            <td style='width:5%'> - </td>
            <td style='width:5%'> <?= isset($r->scoreFinalB) ? $r->scoreFinalB : '?' ?> </td>
            <td style='width:40%'>
                <?php
                    foreach ($equipes as $e) {
                        if ($e[0]->idEquipe == $r->idEquipeB) {
                            echo $e[0]->nomEquipe;
                        }
                    }
                    ?></td>
        </tr>
<?php

endforeach;
echo '</table>';
require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";
