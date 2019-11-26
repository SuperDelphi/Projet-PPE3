<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <h2><?= mb_strtoupper($joueur->nom) .' '. $joueur->prenom ?></h2>
    <hr>

    <div>
        <b>Equipe :</b>
        <label><?= $joueur->nomEquipe ?></label>
    </div>
    <div>
        <b>Age :</b>
        <label><?= $joueur->age . ' ans'?></label>
    </div>
    <div>
        <b>E-mail :</b>
        <label><?= ($joueur->mail == '') ? 'inconnu' : $joueur->mail ?></label>
    </div>
    <div>
        <b>Adresse :</b>
        <label><?= ($joueur->adresse == '') ? 'inconnu' : $joueur->adresse ?></label>
    </div>
    
    <div>
        <b>Licence :</b>
        <label><?= $joueur->licenceJoueur ?></label>
    </div>
    <div>
        <b>Classement :</b>
        <label><?= $joueur->scoreGlobale ?></label>
    </div>

    <hr>
    <a class="button primarybuttonBlue" href="<?= BASE_URL . DS . "admin" . DS . "listeJoueur" ?>">Retour</a>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>