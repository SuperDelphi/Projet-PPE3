<section >
    <form method="post" action="<?= BASE_URL ?>/joueur/supprimer">
        <table border=1 style="text-align : center">
            <thead>
                <tr>
                    <th>test</th>

                </tr>
            </thead>
            <?php foreach ($classement as $c) : ?>
                <tr>
                    <td><?= $c->nomEquipe ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </form>
</section>

