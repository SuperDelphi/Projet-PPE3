<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <h2>Simuler un classement</h2>
    <hr>

    <table class="form-table">
        <form action="" method="POST">
            <tr>
                <td><label>Nom du joueur A</label></td>
                <td><input class="form-control" type="text" name="nomJoueurA" value="" size="20" required
                           placeholder="Joueur A"></td>
            </tr>

            <tr>
                <td><label>Classement du joueur A</label></td>
                <td><input class="form-control" type="number" name="ClassementJoueurA" value="" size="20" min="500"
                           required placeholder="500"/></td>
            </tr>

            <tr>
                <td><label>Nom du joueur B</label></td>
                <td><input class="form-control" type="text" name="nomJoueurB" value="" size="20" required
                           placeholder="Joueur B"/></td>
            </tr>
            <tr>
                <td><label>Classement du joueur B</label></td>
                <td><input class="form-control" type="number" name="ClassementJoueurB" value="" size="20" min="500"
                           required placeholder="500"/></td>
            </tr>
            <tr>
                <td><label>Gagnant</label></td>
                <td>
                    <select class="form-control" name="Gagnant" required>
                        <option value="JoueurA">Joueur A
                        </option>
                        <option value="JoueurB">Joueur B
                        </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "joueur/liste"; ?>">Retour</a>
                    <input class="primarybuttonBlue" type="submit" value="Simuler" name="creerSimulation"/>
                </td>
            </tr>
        </form>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>