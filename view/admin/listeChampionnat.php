<div class="row mx-0">
    <?php require_once ROOT . DS . "view". DS ."layout".DS."admin_menu.php"; ?>
    <div id="admin-body" class="col">
        <h2 class="">Liste des championnats</h2>
        <form method="post" action="<?= BASE_URL ?>">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Division</th>
                    </tr>
                </thead>
                <?php foreach ($championnats as $c) : ?>
                    <tr>
                        <td><a href="<?php echo BASE_URL . '/admin/listeJournee/' . $c->idChampionnat; ?>"><?= $c->nomChampionnat ?></a></td>
                        <td><?= $c->typeChampionnat ?></td>
                        <td><?= $c->nomDivision ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>
</div>