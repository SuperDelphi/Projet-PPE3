<?php

class Gerant extends Personne
{
    
    var $table = "gerant inner join personne on gerant.idGerant = personne.idPersonne";
    
    private $mdp;

    public function __construct($nom, $prenom, $age, $mail, $adresse, $mdp)
    {
        parent::__construct($nom, $prenom, $age, $mail, $adresse);
        $this->mdp = $mdp;
    }
}