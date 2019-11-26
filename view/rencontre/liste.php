<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . ' ' . $championnat->nomDivision; ?></h2>
    </div>
    <hr>

    <?php
    $cpt = 1;
    $idJournee = $rencontres[0]['idJournee'];
    ?>

    <div>
        <h3><a href="<?= BASE_URL ?>/rencontre/listeEquipePoule/?idChampionnat=<?= $championnat->idChampionnat ?>
    <?php if (isset($nomPoule)) {
                echo "&nomPoule=$nomPoule";
            } ?>"
            ><?php if (isset($nomPoule)) {
                echo 'Poule ' . $nomPoule;
            } ?></h3><h6>Classement des équipes</a></h6>
    </div>
    <br>
    <div>
        <div class="col-lg-12">
            <table border='1' style="width:100%" class="data-table">
                <thead class="text-center">
                <th colspan="5">J<?= $cpt++ . '<br>' . $rencontres[0][0]['rencontre']->datePrev ?></th>
                </thead>
                <tbody>
                <?php
                foreach ($rencontres

                as $r) :
                //var_dump($r);
                if ($r[0]['rencontre']->idJournee == $idJournee) {
                    ?>
                    <tr>
                        <td style='width:40%'><a
                                    href="<?php echo BASE_URL . '/joueur/liste/' . $r[0]['rencontre']->idEquipeA ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                        echo $e->nomEquipe;
                                    }
                                }
                                ?></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                        <td style='width:5%'><a
                                    href="<?php echo BASE_URL . '/rencontre/detail/?idRencontre=' . $r[0]['rencontre']->idRencontre;
                                    if (isset($nomPoule)) {echo '&nomPoule=' . $nomPoule; } ?>"><i class="far fa-list-alt"></i></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                        <td style='width:40%'><a
                                    href="<?php echo BASE_URL . '/joueur/liste/' . $r[0]['rencontre']->idEquipeB ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                        echo $e->nomEquipe;
                                    }
                                }
                                ?></a></td>
                    </tr>
                    <?php
                } else { ?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="col-lg-12">
            <table border='1' style="width:100%" class="data-table">
                <thead class="text-center">
                <th colspan="5">J<?= $cpt++ . '<br>' . $r[0]['rencontre']->datePrev ?></th>
                </thead>
                <tbody>
                <tr>
                    <td style='width:40%'><a
                                href="<?php echo BASE_URL . '/rencontre/detail/' . $r[0]['rencontre']->idRencontre ?>">
                            <?php
                            foreach ($equipes as $e) {
                                if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                    echo $e->nomEquipe;
                                }
                            }
                            ?></a></td>
                    <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                    <td style='width:5%'><a
                                    href="<?php echo BASE_URL . '/rencontre/detail/?idRencontre=' . $r[0]['rencontre']->idRencontre;
                                    (isset($nomPoule)) ? '&nomPoule=' . $nomPoule : "" ?>"><i class="far fa-list-alt"></i></a></td>
                    <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                    <td style='width:40%'>
                        <?php
                        foreach ($equipes as $e) {
                            if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                echo $e->nomEquipe;
                            }
                        }
                        ?> </td>
                </tr>
                <?php $idJournee = $r[0]['rencontre']->idJournee;
                }
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>