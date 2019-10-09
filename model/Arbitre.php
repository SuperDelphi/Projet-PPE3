<?php

class Arbitre extends Personne
{
    private $mdp;

    public function __construct($nom, $prenom, $age, $mail, $adresse, $mdp)
    {
        parent::__construct($nom, $prenom, $age, $mail, $adresse);
        $this->mdp = $mdp;
    }
}