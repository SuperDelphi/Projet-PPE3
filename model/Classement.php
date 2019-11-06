<?php

class Classement extends Model {
    var $table = "equipe inner join division on equipe.idDivision = division.idDivision inner join championnat on division.idDivision = championnat.idDivision" ;
    // championnat inner join engagement on championnat.idChampionnat = engagement.idChampionnat inner join equipe on equipe.idEquipe = engagement.idEquipe 
}
?>

