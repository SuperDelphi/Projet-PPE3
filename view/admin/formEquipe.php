<table>
    <form action="" method="POST">
        <thead>
            <th><label>Création d'un Championnat</label></th>
        </thead>
        <tr>
            <td><label>Nom Equipe</label></td>
            <td><input type="text" name="nomEquipe" value="" size="20" /></td>
        </tr>
        <tr>
            <td>
                <label>Nom Club</label><br>
                
            </td>
            <td>
                <select name="idClub" required>
                     <?php foreach ($clubs as $c) : ?>
                    <option value="<?= $c->idClub ?>">
                        <?= $c->nomClub ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Division</label></td>
            <td>
                <select name="idDivision" required>
                    <?php
                    foreach ($divisions as $division) : ?>
                        <option value="<?= $division->idDivision ?>">
                            <?= $division->nomDivision ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Créer" name="creerEquipe" /></td>
        </tr>
    </form>
</table>