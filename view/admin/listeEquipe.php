<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

        <div class="col-lg">
            <h2 class="">Liste des Equipes</h2>
            <form method="post" action="formEquipe.php">
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>Nom Equipe</th>
                        <th>Club</th>
                        <th>Division</th>
                        <th><input class="primarybuttonBlue" type="button" value="Nouvelle Equipe"
                                   onClick="self.location.href='<?= BASE_URL . DS ?>/admin/formEquipe'"/></th>

                    </tr>
                    </thead>
                    <?php foreach ($equipes as $e) : ?>
                        <tr>
                            <td><?= $e->nomEquipe ?></td>
                            <td> <?= $e->nomClub ?></td>
                            <td> <?= $e->idDivision ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </form>
        </div>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>