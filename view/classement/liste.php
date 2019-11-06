<section >
    <form method="post" action="<?= BASE_URL ?>/joueur/supprimer">
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>1</th>
                    <th>2</th>
                </tr>
            </thead>
            <?php foreach ($classement as $c) : ?>
                <tr>
                    <td><?= $c->nomEquipe ?></td>
                    <td><?= $c->scoreGlobal ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </form>
</section>

