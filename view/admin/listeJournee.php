<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2><?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat . " " . $championnat->nomDivision; ?> : Liste des journées</h2>
    <hr>

<?php

$cpt = 1;
$nomPoule = "";

// Supporte jusqu'à 2 poules
$midPointer = count($journee) / 2;

if ($hasPoules) {
    $p1 = array_slice($journee, 0, $midPointer);
    $p2 = array_slice($journee, $midPointer, $midPointer);

    $poules = [
        "Poule A" => $p1,
        "Poule B" => $p2
    ];
} else {
    $poules = ["Liste" => $journee];
}

echo '<div class="row">';

foreach ($poules as $nom => $p) {
    echo "<table class='data-table sober col" . ($hasPoules ? "-6" : "") . "'>
            <thead>
                <th>$nom</th>
            </thead>
            <tbody>";

    foreach ($p as $j): ?>
    <tr class="hover-accent">
        <td>Journée <?= $cpt++ . " - " . date("d/m/y", strtotime($j->datePrev)) ?></td>
        <td class="row button-container">
            <a href="<?php echo BASE_URL .
                "/admin/listeRencontre/?idchampionnat=" . $championnat->idChampionnat . "&idjournee="
                . $j->idJournee . ($hasPoules ? ("&nompoule=" . $nom[strlen($nom) - 1]) : "")
            ?>" class="button primarybuttonBlue col-lg text-center">Voir</a>
        </td>
    </tr>
    <?php endforeach;

    echo "  </tbody>
          </table>";
}

echo '</div>';

require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";