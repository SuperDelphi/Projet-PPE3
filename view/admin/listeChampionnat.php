<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2 class="">Liste des championnats</h2>
    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formChampionnat" ?>"
       class="button primarybuttonBlue">Nouveau</a>
    <form method="post" action="<?= BASE_URL ?>">
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
                        ?>" class="button primarybuttonBlue">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>