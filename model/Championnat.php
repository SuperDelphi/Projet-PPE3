<?php
class Championnat extends Model {
    var $table = "championnat inner join engagement on championnat.idChampionnat = engagement.idChampionnat inner join equipe on equipe.idEquipe = engagement.idEquipe " ;
}
?>