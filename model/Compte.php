<?php


class Compte extends Personne
{
    // Les gérants sont représentés par la classe Compte, dont hérite la classe Arbitre.
    var $table = "compte INNER JOIN personne ON compte.idCompte = personne.idPersonne";

    private $mdp;

    public function __construct($nom, $prenom, $age, $mail, $adresse, $mdp)
    {
        parent::__construct($nom, $prenom, $age, $mail, $adresse);
        $this->mdp = $mdp;
    }
}