<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Nouvelle rencontre</h2>
<hr>

<table class="form-table" ">
    <form method="POST" action="">
        <tr>
            <td><label>Heure</label></td>
            <td><input class="form-control" type="time" name="heure" value="" size="20" required/></td>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="" size="20" required/></td>
            <td><label>Lieu</label></td>
            <td><input class="form-control" type="text" name="lieu" value="" size="20" required/></td>
        </tr>  
        <tr>
            <td><label>Équipe A</label></td>
            <td>
                <select class="form-control" name="equipea" required>
                    <?php
                    foreach ($equipes as $equipe) : ?>
                        <option value="<?= $equipe->idEquipe ?>">
                            <?= $equipe->nomEquipe ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><label>Équipe B</label></td>
            <td>
                <select class="form-control" name="equipeb" required>
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
            <td><label>Score de l'équipe A</label></td>
            <td><input class="form-control" type="number" name="scorea" value="" size="20" required/></td>
            <td><label>Score de l'équipe B</label></td>
            <td><input class="form-control" type="number" name="scoreb" value="" size="20" required/></td>
        </tr>
        <tr>
            <td><label>Journée</label></td>
            <td>
            <select class="form-control" name="journee" required>
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
            <select class="form-control" name="arbitre" required>
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
            <td>
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Annuler</a>
                <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="creerrencontre"/>
            </td>
        </tr>
    </form>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>