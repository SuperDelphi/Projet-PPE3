<section>
    <h2>Liste des championnats</h2>
    <form method="post" action="<?= BASE_URL ?>">
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Division</th>
                </tr>
            </thead>
            <?php foreach ($championnats as $c) : ?>
                <tr>
                    <td><a href="<?php echo BASE_URL . '/rencontre/liste/' . $c->nomChampionnat; ?>" 
                           title="Cliquez pour modifier"><?= $c->nomChampionnat ?></a></td>
                    <td> <?= $c->typeChampionnat ?></td>
                    <td> <?= $c->nomDivision ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>
</section>