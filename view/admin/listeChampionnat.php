<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Liste des championnats</h2>
    <hr>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formChampionnat" ?>"
       class="button primarybuttonBlue">
        <i class="fas fa-plus fa-sm"></i> Nouveau championnat</a>

    <table class="data-table sober">
        <?php foreach ($championnats as $c) : ?>
            <?php
            $pouleAmount = 0;

            foreach ($poules as $p) {
                if ($p->idChampionnat === $c->idChampionnat) {
                    $pouleAmount++;
                }
            }

            $nomChampionnat = ArrayWizard::getFirstElementWhere(
                    $championnats,
                    "idChampionnat",
                    $c->idChampionnat
                )->nomChampionnat . " " . $c->typeChampionnat . " "
                . $c->nomDivision . ($pouleAmount ? "<b style='color: #00379a'> • $pouleAmount poules</b>" : "");

            ?>
            <tr>
                <td class="text-left">
                    <?= $nomChampionnat ?>
                </td>
                <td>
                    <a href="<?= BASE_URL . DS . "admin" . DS . "listeJournee/" . $c->idChampionnat
                    ?>" class="button primarybuttonBlue">Gérer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>