<?php

class Arbitre extends Compte
{
    var $table = "arbitre inner join personne on arbitre.idArbitre = personne.idPersonne";
    
    private $mdp;

    /*public function __construct($nom, $prenom, $age, $mail, $adresse, $mdp, $identifiant)
    {
        parent::__construct($nom, $prenom, $age, $mail, $adresse);
        $this->mdp = $mdp;
        $this->identifiant = $identifiant;
    }*/
}