<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2><?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat . " " . $championnat->nomDivision; ?></h2>
<hr>

<?php
$cpt = 0;
foreach ($rencontre as $r) :
    ?>
    <table border='1' style='text-align:center' class="data-table">
        <tr>
            <td style='width:40%'><a href="<?php echo BASE_URL . '/rencontre/detail/' . $r->idRencontre; ?>">
                    <?php
                        foreach ($equipes as $e) {
                            if ($e->idEquipe === $r->idEquipeA) {
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
                    ?></td>

        </tr>
    </table>
<?php

endforeach;

require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";
