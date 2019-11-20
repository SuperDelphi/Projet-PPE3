<h2><?= $championnat->nomChampionnat . '<br>' . $championnat->typeChampionnat . '<br>' . $championnat->nomDivision; ?></h2>
<?php
$cpt=1;
$nomPoule= "";

foreach ($journee as $j) : 
    if($cpt== 1){
        echo "Poule A"; 
        $nomPoule = "A";
    } elseif($cpt==11){
        echo "Poule B";
        $nomPoule = "B";
    }
    ?>
    <div style=''>

        <a href=" <?= BASE_URL."/admin/listeRencontre/". $championnat->idChampionnat . "-" . $j->idJournee."-". $nomPoule ?>" colspan="5">J<?= $cpt++." ". $j->datePrev ?></a>

    </div>
<?php

endforeach;
