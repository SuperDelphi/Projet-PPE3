<section >
    
    <table border=1 style="text-align : center">
        <thead>
            <tr>
                <th colspan="2">Classement des équipes</th>
            </tr>
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

