<?php
class Joueur extends Personne
{
    var $idClub;
    var $licence;
    var $visible;

    function __construct($nom, $prenom, $age, $mail, $adresse, $idClub, $licence, $visible)
    {
        parent::__construct($nom, $prenom, $age, $mail, $adresse);
        $this->idClub = $idClub;
        $this->licence = $licence;
        $this->visible = $visible;

    }

    function getJoueurByNom($nom){
        $j[joueurs] = $this->find(array('conditions' => array('nom' => $nom)));
        return $j;
    }
}
