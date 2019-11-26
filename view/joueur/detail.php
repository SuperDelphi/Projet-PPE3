<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>
<section >
    <h2><?= $joueur->nom .' '. $joueur->prenom ?></h2>
    <div>
        <label>Equipe :</label>
        <label><?= $joueur->nomEquipe ?></label>
    </div>
    <div>
        <label>Age :</label>
        <label><?= $joueur->age . ' ans'?></label>
    </div>
    <div>
        <label>E-mail :</label>
        <label><?= ($joueur->mail == '') ? 'inconnu' : $joueur->mail ?></label>
    </div>
    <div>
        <label>Adresse :</label>
        <label><?= ($joueur->adresse == '') ? 'inconnu' : $joueur->adresse ?></label>
    </div>
    
    <div>
        <label>Licence :</label>
        <label><?= $joueur->licenceJoueur ?></label>
    </div>
    <div>
        <label>Classement :</label>
        <label><?= $joueur->scoreGlobale ?></label>
    </div>
</section>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>