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
                <label>(Départemental, régional, ...)</label>
            </td>
            <td>
                <select name="typeChampionnat" required>
                    <?php
                    foreach ($typesChampionnat as $typeChampionnat) : ?>
                        <option value="<?= $typeChampionnat ?>">
                            <?= $typeChampionnat ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Nombre de journée</label></td>
            <td><input type="number" name="nombreJournee" /></td>
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
            <td><input type="submit" value="Créer" name="creerChampionnat" /></td>
        </tr>
    </form>
</table>