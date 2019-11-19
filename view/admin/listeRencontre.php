<h2><?= $championnat->nomChampionnat . '<br>' . $championnat->typeChampionnat . '<br>' . $championnat->nomDivision; ?></h2>
<?php foreach ($journee as $j) :
    foreach ($j as $rencontre) :
        if (gettype($rencontre) == "string") { ?>

            <div style=''>
                <table class="data-table">
                    <thead>
                        <th colspan="5"><?= $rencontre ?></th>
                    </thead>

                    <?php
                            } else {
                                foreach ($rencontre as $r) : ?>

                        <tr>
                            <td style='width:40%'>
                                <?php foreach ($equipes as $e) {
                                                    if ($e->idEquipe == $r->idEquipeA) {
                                                        echo $e->nomEquipe;
                                                    }
                                                } ?></td>
                            <td style='width:5%'> <?= isset($r->scoreFinalA) ? $j->scoreFinalA : '?' ?> </td>
                            <td style='width:5%'> - </td>
                            <td style='width:5%'> <?= isset($r->scoreFinalB) ? $j->scoreFinalB : '?' ?> </td>
                            <td style='width:40%'>
                                <?php foreach ($equipes as $e) {
                                                    if ($e->idEquipe == $r->idEquipeB) {
                                                        echo $e->nomEquipe;
                                                    }
                                                } ?> </td>
                        </tr> <?php endforeach; ?>
                    <tr><a href="<?php echo BASE_URL . '/admin/listeRencontre/' . $j->idJournee; ?>" title="Cliquez pour modifier">Modifier</a></tr>

                </table>
                <br>
            </div>

<?php }
    endforeach;
endforeach;
