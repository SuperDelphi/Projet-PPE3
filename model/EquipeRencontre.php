<?php
require_once("Personne.php");

class EquipeRencontre extends Model
{
    var $table = "rencontre inner join arbitre on rencontre.idArbitre = rencontre.idArbitre "
            . "inner join equipe on rencontre.idEquipeA = equipe.idEquipe "
            . "inner join journee on rencontre.idJournee = journee.idJournee "
            . "inner join championnat on journee.idChampionnat = championnat.idChampionnat";
}
