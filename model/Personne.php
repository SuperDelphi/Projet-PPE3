<?php
class Personne
{
    var $nom;
    var $prenom;
    var $age;
    var $mail;
    var $adresse;

    function __construct($nom, $prenom, $age, $mail, $adresse){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->mail = $mail;
        $this->adresse = $adresse;
    }
}

