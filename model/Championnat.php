<?php


class Championnat extends Model {
    var $table = "division 
        INNER JOIN championnat ON division.idDivision = championnat.idDivision
        INNER JOIN engagement ON championnat.idChampionnat = engagement.idChampionnat
        INNER JOIN equipe ON equipe.idEquipe = engagement.idEquipe ";
}