<?php


class Personne extends Model
{
    var $nom, $prenom, $age, $sexe, $mail, $adresse;

    function __construct($nom, $prenom, $age, $sexe, $mail, $adresse)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->sexe = $sexe;
        $this->mail = $mail;
        $this->adresse = $adresse;
    }
}