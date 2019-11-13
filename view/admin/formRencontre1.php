<br>
<table>
    <form method="POST" action="<?= BASE_URL . DS ?>admin/formRencontre2">
        <thead>
        <th><label>Nouvelle Rencontre 1</label></th>
        </thead>
        <tr>
            <td><label>Equipe A</label></td>
            <td><input type="text" name="equipea" value="" size="20" /></td>
            <td><label>Equipe B</label></td>
            <td><input type="text" name="equipeb" value="" size="20" /></td>
        </tr>
        <tr>
            <td><label>Score Equipe A</label></td>
            <td><input type="text" name="scoreea" value="" size="20" /></td>
            <td><label>Score Equipe B</label></td>
            <td><input type="text" name="scoreeb" value="" size="20" /></td> 
        </tr>
        <tr>
            <td><input type="submit" value="Suivant" name="etape1" /></td>
        </tr>
    </form>
</table>