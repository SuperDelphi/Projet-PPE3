<section >
    <form method="post" action="<?= BASE_URL ?>/joueur/supprimer">
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>

                </tr>
            </thead>
            <?php foreach ($classement as $c) : ?>
                <tr>
                    <td><?= $c->idEquipe ?></td>
                    <td><?= $c->nomEquipe ?></td>
                    <td><?= $c->idDivision ?></td>
                    <td><?= $c->nomDivision ?></td>
                    <td><?= $c->idChampionnat ?></td>
                    <td><?= $c->nomChampionnat ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </form>
</section>

