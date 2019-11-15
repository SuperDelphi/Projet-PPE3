<section>
    <h2>Classement des équipes</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Equipes</th>
                <th>Score</th>
            </tr>
        </thead>
        <?php foreach ($classement as $c) : ?>
            <tr>
                <td><?= $c->nomEquipe ?></td>
                <td><?= $c->scoreGlobal ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

