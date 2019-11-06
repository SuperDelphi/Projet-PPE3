<?php

class Classement extends Model {
    var $table = "equipe inner join division on equipe.idDivision = division.idDivision inner join championnat on division.idDivision = championnat.idDivision" ;
}
?>

