<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des championnats</h2>
        <hr>

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
                                        <a href="<?php echo BASE_URL .
                                            "/rencontre/liste/?idChampionnat=$c->idChampionnat&nomPoule=$p->nomPoule"
                                        ?>" class="button primarybuttonBlue">Voir</a>
                                        <a href="<?php echo BASE_URL .
                                            "/rencontre/listeEquipePoule/?idChampionnat=$c->idChampionnat&nomPoule=$p->nomPoule"
                                        ?>" class="button primarybuttonWhite">Classement</a>
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
                                        <a href="<?php echo BASE_URL .
                                            "/rencontre/liste/?idChampionnat=$c->idChampionnat"
                                        ?>" class="button primarybuttonBlue">Voir</a>
                                        <a href="<?php echo BASE_URL .
                                            "/rencontre/listeEquipePoule/?idChampionnat=$c->idChampionnat"
                                        ?>" class="button primarybuttonWhite">Classement</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                <?php endforeach; ?>
            </table>
        </form>
    </div>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>