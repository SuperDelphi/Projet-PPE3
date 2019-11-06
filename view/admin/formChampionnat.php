<table>
    <form action="" method="POST">
        <thead>
            <th><label>Création d'un Championnat</label></th>
        </thead>
        <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nomChampionnat" value="" size="20" /></td>
        </tr>
        <tr>
            <td>
                <label>Type</label><br>
                <label>(Junior, Senior, ...)</label>
            </td>
            <td><input type="text" name="typeChampionnat" value="" size="20" /></td>
        </tr>
        <tr>
            <td><label>Division</label></td>
            <td>
                <select name="nomDivison" required>
                    <?php
                    foreach ($divisions as $division) : ?>
                    <option id="<?= $division->idDivision ?>">
                        <?= $division->nomDivision ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Créer" name="creerChampionnat" /></td>
        </tr>
    </form>
</table>