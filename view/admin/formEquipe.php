<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Nouvelle équipe</h2>
<hr>

<form method="POST">

    <label>Nom de l'équipe</label>
    <input class="form-control" type="text" name="nomEquipe" value="" size="20" required/>

    <label>Club</label><br>

    <select class="form-control" name="idClub" required>
        <?php foreach ($clubs as $c) : ?>
            <option value="<?= $c->idClub ?>">
                <?= $c->nomClub ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Division</label>

    <select class="form-control" name="idDivision" required>
        <?php
        foreach ($divisions as $division) : ?>
            <option value="<?= $division->idDivision ?>">
                <?= $division->nomDivision ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br>

    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeEquipe" ?>">Annuler</a>
    <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="creerEquipe"/>

</form>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>