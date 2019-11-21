<br>
<table>
    <form method="POST" action="<?= BASE_URL . DS ?>admin/">
        <thead>
            <th><label>Nouvelle Journée</label></th>
        </thead>
        <tr>
            <td><label>Numéro de la journée : </label></td>
            <td><select>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select></td>
            <td><label>Date prévisionnel de la journée : </label></td>
            <td><input type="date" id="date-previsionnel" name="date-previsionnel"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Créer" name="Créer" /></td>
        </tr>
    </form>
</table>