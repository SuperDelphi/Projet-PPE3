<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Nouvelle journée</h2>
    <hr>

    <form method="POST" action="<?= BASE_URL . DS ?>admin/">

        <label>Numéro</label>
        <select class="form-control" required>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <br>
        <label>Date prévisionnelle</label>
        <input class="form-control" type="date" id="date-previsionnel" name="date-previsionnel" required>
        <br>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Annuler</a>
        <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="Enregistrer"/>

    </form>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>