<div class="row mx-0">
    <div class="col-lg-2" style="background-color: lightblue">
        <div class="row border border-dark text-center">
            <div class="col">
                <a href="<?= BASE_URL . DS ?>admin/formChampionnat">Nouveau championnat</a>
            </div>
        </div>
        <br>
        <div class="row border border-dark text-center">
            <div class="col">
                <a href="<?= BASE_URL . DS ?>admin/formRencontre1">Nouvelle Rencontre</a>
            </div>
        </div>
        <br>
        <div class="row border border-dark text-center">
            <div class="col">
                <a href="<?= BASE_URL . DS ?>admin/formJournee">Nouvelle Journée</a>
            </div>
        </div>
        <br>
        <div class="row border border-dark text-center">
            <div class="col">
                <a href="<?= BASE_URL . DS ?>auth/logout">Déconnexion</a>
            </div>
        </div>
    </div>
    <div class="col-lg">
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
                        <td><a href="<?php echo BASE_URL . '/rencontre/liste/' . $c->idChampionnat; ?>"><?= $c->nomChampionnat ?></a></td>
                        <td> <?= $c->typeChampionnat ?></td>
                        <td> <?= $c->nomDivision ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>
</div>