<br> <!== <?= BASE_URL . DS ?>admin/formRencontre2 !>
<table>
    <form method="POST" action="">
        <thead>
            <th><label>Nouvelle Rencontre 2</label></th>
        <th><label>Nouvelle Rencontre 1</label></th>
        </thead>
        <tr>
            <td><label>Heure</label></td>
            <td><input type="time" name="heure" value="" size="20" /></td>
            <td><label>Date</label></td>
            <td><input type="date" name="date" value="" size="20" /></td> 
            <td><label>Lieu</label></td>
            <td><input type="text" name="lieu" value="" size="20" /></td> 
        </tr>  
        <tr>
            <td><label>Equipe A</label></td>
            <td><input type="text" name="equipea" value="" size="20" /></td>
            <td><label>Equipe B</label></td>
            <td><input type="text" name="equipeb" value="" size="20" /></td>
        </tr>
        <tr>
            <td><label>Joueur A</label></td>
            <td><input type="text" name="joueura" value="" size="20" /></td>
            <td><label>Joueur X</label></td>
            <td><input type="text" name="joueurx" value="" size="20" /></td>
        </tr>
        <tr>
            <td><label>Joueur B</label></td>
            <td><input type="text" name="joueurb" value="" size="20" /></td>
            <td><label>Joueur Y</label></td>
            <td><input type="text" name="joueury" value="" size="20" /></td>
        </tr>
        <tr>
            <td><label>Joueur C</label></td>
            <td><input type="text" name="joueurc" value="" size="20" /></td>
            <td><label>Joueur Z</label></td>
            <td><input type="text" name="joueurz" value="" size="20" /></td>
        </tr>
        <tr>
        <tr>
            <td><label>Score Equipe A</label></td>
            <td><input type="text" name="scoreea" value="" size="20" /></td>
            <td><label>Score Equipe B</label></td>
            <td><input type="text" name="scoreeb" value="" size="20" /></td> 
        </tr>
        <tr>
            <td><label>Journee</label></td>
            <td><input type="text" name="journee" value="" size="20" /></td>
            <td><label>Arbitre</label></td>
            <td><input type="text" name="arbitre" value="" size="20" /></td> 
        </tr>
        <tr>
            <td><input type="submit" value="Terminer" name="creerrencontre" /></td>
        </tr>
    </form>
</table>