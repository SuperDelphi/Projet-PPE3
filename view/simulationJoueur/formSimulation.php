<table>
    <form action="" method="POST">
        <thead>
        <th><label>Simulation d'un classement</label></th>
        </thead>
        <tr>
            <td><label>Nom Joueur A</label></td>
            <td><input type="text" name="nomJoueurA" value="" size="20" required placeholder="JoueurA" /></td>
        </tr>

        <tr>
            <td><label>Classement Joueur A</label></td>
            <td><input type="number" name="ClassementJoueurA" value="" size="20" min="500" required placeholder="500" /></td>
        </tr>

        <tr>
            <td><label>Nom Joueur B</label></td>
            <td><input type="text" name="nomJoueurB" value="" size="20" required placeholder="JoueurB" /></td>
        </tr>
        <tr>
            <td><label>Classement Joueur B</label></td>
            <td><input type="number" name="ClassementJoueurB" value="" size="20" min="500" required placeholder="500" /></td>
        </tr>
        <tr>
            <td><label>Gagnant</label></td>
            <td>
                    <select name="Gagnant" required>
                    <option value="JoueurA">JoueurA
                    </option>
                    <option value="JoueurB">JoueurB
                    </option>
                </select>
            </td>
        </tr>

        <tr>
            <td><input type="submit" value="Simuler" name="creerSimulation" /></td>
        </tr>
    </form>
</table>