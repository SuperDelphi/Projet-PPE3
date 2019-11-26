<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Nouveau joueur</h2>
<hr>

<form method="POST">

    <label>Nom</label>
    <input class="form-control" type="text" name="nom" value="" size="20" required/>

    <label>Prénom</label>
    <input class="form-control" type="text" name="prenom" value="" size="20" required/>
    
    <label>Genre</label>
    <br>
    <label>Masculin</label> <input  type="radio" name="sexe" value="M" required/>
    <label>Féminin </label> <input type="radio" name="sexe" value="F" required/> 

    <br>
    <label>Licence</label>
    <input class="form-control" type="text" name="licence" value="" size="20" required/>

    <label>Classement</label>
    <input class="form-control" type="number" name="scoreGlobale" value="" size="20" required/>

    <label>Equipe</label><br>

    <select class="form-control" name="idEquipe" required>
        <?php foreach ($equipes as $e) : ?>
            <option value="<?= $e->idEquipe ?>">
                <?= $e->nomEquipe ?>
            </option>
        <?php endforeach; ?>
    </select>

    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeJoueur" ?>">Annuler</a>
    <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="creerJoueur"/>

</form>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>