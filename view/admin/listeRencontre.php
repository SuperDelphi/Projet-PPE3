<h2><?= $championnat->nomChampionnat . '<br>' . $championnat->typeChampionnat . '<br>' . $championnat->nomDivision; ?></h2>

<?php
$cpt = 0; 
foreach ($rencontre as $r) : 
    ?>

    <div style=''>

        <a href=" <?= BASE_URL."/admin/formRencontre/". $r->idRencontre ?>" colspan="5"><?= $equipes[$cpt]->nomEquipe." ".$equipes[$cpt++]->nomEquipe ?></a>

    </div>
<?php

endforeach;
