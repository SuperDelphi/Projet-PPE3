<?php
require_once("Personne.php");

class Joueur extends Personne
{
    var $table = "joueur inner join personne on joueur.idJoueur = personne.idPersonne inner join club on club.idClub = joueur.idClub ";
/*    var $idClub;
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
    }*/
}
