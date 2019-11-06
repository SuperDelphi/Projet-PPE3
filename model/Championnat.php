<?php


class Championnat extends Model {
    var $table = "championnat
        INNER JOIN engagement ON championnat.idChampionnat = engagement.idChampionnat
        INNER JOIN equipe ON equipe.idEquipe = engagement.idEquipe ";
}