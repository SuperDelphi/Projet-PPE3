<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2><?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat . " " . $championnat->nomDivision; ?> : Liste des journées</h2>
    <hr>
    <table class="data-table sober">
<?php

$cpt = 1;
$nomPoule = "";

echo '';
foreach ($journee as $j) :
    if ($cpt == 1) {
        echo "<tr><td colspan=2>Poule A</td></tr>";
        $nomPoule = "A";
    } elseif ($cpt == 11) {
        echo "<tr><td colspan=2>Poule B</td></tr>";
        $nomPoule = "B";
    }
    ?>
    <tr>
        <td>J<?= $cpt++ . " : " . $j->datePrev ?></td>
        <td class="row">
            <a href="<?php echo BASE_URL .
                "/admin/listeRencontre/?idchampionnat=" . $championnat->idChampionnat . "&idjournee=" . $j->idJournee . "&nompoule=" . $nomPoule
            ?>" class="button primarybuttonBlue col-lg text-center">Voir</a>
        </td>
    </tr>
<?php

endforeach;
echo '</table>';
require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";