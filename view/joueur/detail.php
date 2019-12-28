<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <h2><?= mb_strtoupper($joueur->nom) .' '. $joueur->prenom ?></h2>
    <hr>

    <div>
        <b>Équipe :</b>
        <label><?= $joueur->nomEquipe ?></label>
    </div>
    <div>
        <b>Âge :</b>
        <label><?= $joueur->age . ' ans'?></label>
    </div>
    <div>
        <b>E-mail :</b>
        <label><?= ($joueur->mail === '') ? '-' : $joueur->mail ?></label>
    </div>
    <div>
        <b>Adresse :</b>
        <label><?= ($joueur->adresse === '') ? '-' : $joueur->adresse ?></label>
    </div>
    
    <div>
        <b>Licence :</b>
        <label><?= mb_strtoupper($joueur->licenceJoueur) ?></label>
    </div>
    <div>
        <b>Classement :</b>
        <label><?= $joueur->scoreGlobale ?></label>
    </div>

    <hr>
    <a class="button primarybuttonBlue" href="<?= BASE_URL . DS . "admin" . DS . "listeJoueur" ?>">Retour</a>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>