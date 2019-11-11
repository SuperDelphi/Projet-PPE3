<?php
require_once("Personne.php");

class Joueur extends Personne
{
    var $table = "joueur inner join personne on joueur.idJoueur = personne.idPersonne inner join equipe on equipe.idEquipe = joueur.idEquipe";
}
