<?php 
class Rencontre extends Model {
    var $table = "championnat 
    INNER JOIN journee ON championnat.idChampionnat = journee.idChampionnat 
    INNER JOIN rencontre ON journee.idJournee = rencontre.idJournee ";
}