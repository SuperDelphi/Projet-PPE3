<?php 
class Rencontre extends Model {
    var $table = "rencontre inner join journee on rencontre.idJournee = journee.idJournee "
            . "inner join championnat on journee.idChampionnat = championnat.idChampionnat";
}