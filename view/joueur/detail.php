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
        <label>Score :</label>
        <label><?= $joueur->scoreGlobal ?></label>
    </div>
</section>