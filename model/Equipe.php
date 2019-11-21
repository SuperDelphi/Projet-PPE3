<?php 
class Equipe extends Model {
    var $table = "equipe inner join club on equipe.idClub=club.idClub";
}