<?php 
class Rencontre extends Model {
    var $table = "rencontre 
    INNER JOIN remplacement ON rencontre.idRencontre = remplacement.idRencontre
    INNER JOIN equipe on rencontre.idRencontre = equipe.idRencontre
    INNER JOIN journee on rencontre.idRencontre = journee.idRencontre
    INNER JOIN championnat on rencontre.idRencontre = championnat.idRencontre " ;
}