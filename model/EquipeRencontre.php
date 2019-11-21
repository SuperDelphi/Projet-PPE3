<?php
require_once("Personne.php");

class EquipeRencontre extends Personne
{
    var $table = "personne inner join joueur on personne.idPersonne = joueur.idJoueur "
            . "inner join equipe on joueur.idEquipe = equipe.idEquipe "
            . "inner join rencontre on equipe.idEquipe = rencontre.idEquipeA "
            . " inner join journee on rencontre.idJournee = journee.idJournee";
}
