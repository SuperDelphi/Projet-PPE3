<br>
<table>
    <form method="POST" action="<?= BASE_URL . DS ?>admin/">
        <thead>
            <th><label>Nouvelle Journée</label></th>
        </thead>
        <tr>
            <td><label>Numéro de la journée</label></td>
            <td><input type="text" name="equipea" value="" size="20" /></td>
            <td><label>Date prévisionnel de la journée</label></td>
            <td><input type="text" name="equipeb" value="" size="20" /></td>
        </tr>
        <tr>
            <td><input type="submit" value="Créer" name="etape1" /></td>
        </tr>
    </form>
</table>