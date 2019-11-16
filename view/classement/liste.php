<section>
    <h2>Classement des équipes</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Place</th>
                <th>Equipes</th>
                <th>Score</th>
            </tr>
        </thead>
        <?php $place = 1; foreach ($classement as $c) : ?>
            <tr>
                <td><?= $place++ ?></td>
                <td><?= $c->nomEquipe ?></td>
                <td><?= $c->scoreGlobal ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

