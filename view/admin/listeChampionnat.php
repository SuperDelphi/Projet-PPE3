<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2 class="">Liste des championnats</h2>
    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formChampionnat" ?>"
       class="button primarybuttonBlue">Nouveau</a>
    <form method="post" action="<?= BASE_URL ?>">
        <table class="data-table sober">
            <?php foreach ($championnats as $c) : ?>
                <?php
                $isPoules = false;
                $nomChampionnat = ArrayWizard::getFirstElementWhere(
                        $championnats,
                        "idChampionnat",
                        $c->idChampionnat
                    )->nomChampionnat . " " . $c->typeChampionnat . " " . $c->nomDivision;

                foreach ($poules as $p) {
                    if ($p->idChampionnat === $c->idChampionnat) {
                        $isPoules = true;
                    }
                }

                if ($isPoules) {
                    foreach ($poules as $p): ?>
                        <tr>
                            <td class="text-left">
                                <?= $nomChampionnat . " <b>[Poule " . $p->nomPoule . "]</b>" ?>
                            </td>
                            <td>
                                <a href="<?= BASE_URL . DS . "admin" . DS . "listeJournee/" . $c->idChampionnat
                                ?>" class="button primarybuttonBlue">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach;
                } else {
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
                    <?php
                }
                ?>
            <?php endforeach; ?>
        </table>
    </form>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>