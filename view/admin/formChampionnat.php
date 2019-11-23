<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Nouveau championnat</h2>
<hr>

<table>
    <form action="" method="POST">
        <tr>
            <td><label>Nom</label></td>
            <td><input class="form-control" type="text" name="nomChampionnat" value="" size="20" required/></td>
        </tr>
        <tr>
            <td>
                <label>Type</label><br>
                <label>(Départemental, régional, ...)</label>
            </td>
            <td>
                <select class="form-control" name="typeChampionnat" required>
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
            <td><input class="form-control" type="number" name="nombreJournee" required/></td>
        </tr>
        <tr>
            <td><label>Division</label></td>
            <td>
                <select class="form-control" name="idDivision" required>
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
            <td><input class="primarybuttonBlue" type="submit" value="Créer" name="creerChampionnat" /></td>
        </tr>
    </form>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>