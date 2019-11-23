<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Liste des équipes</h2>
    <hr>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formEquipe" ?>"
       class="button primarybuttonBlue"><i class="fas fa-plus fa-sm"></i>&nbsp Nouvelle équipe</a>

    <table class="data-table">
        <thead>
        <tr>
            <th>Nom Equipe</th>
            <th>Club</th>
            <th>Division</th>

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

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>