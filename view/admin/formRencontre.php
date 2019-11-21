<br>
<table>
    <form method="POST" action="">
        <thead>
            <th><label>Nouvelle Rencontre</label></th>
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
            <td>
                <select name="equipea" required>
                    <?php
                    foreach ($equipes as $equipe) : ?>
                        <option value="<?= $equipe->idEquipe ?>">
                            <?= $equipe->nomEquipe ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><label>Equipe B</label></td>
            <td>
                <select name="equipeb" required>
                    <?php
                    foreach ($equipes as $equipe) : ?>
                        <option value="<?= $equipe->idEquipe ?>">
                            <?= $equipe->nomEquipe ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Score Equipe A</label></td>
            <td><input type="number" name="scorea" value="" size="20" /></td>
            <td><label>Score Equipe B</label></td>
            <td><input type="number" name="scoreb" value="" size="20" /></td> 
        </tr>
        <tr>
            <td><label>Journee</label></td>
            <td>
            <select name="journee" required>
                    <?php
                    foreach ($journees as $journee) : ?>
                        <option value="<?= $journee->idJournee ?>">
                            <?= $journee->idJournee ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><label>Arbitre</label></td>
            <td>
            <select name="arbitre" required>
                    <?php
                    foreach ($arbitres as $arbitre) : ?>
                        <option value="<?= $arbitre->idArbitre ?>">
                            <?= $arbitre->nom ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Terminer" name="creerrencontre" /></td>
        </tr>
    </form>
</table>