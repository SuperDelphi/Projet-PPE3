<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>
<h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . ' ' . $championnat->nomDivision; ?></h2>
<h3>Classement des équipes
<?php if (isset($poule)) {
    echo ' Poule ' . $poule[0]->nomPoule;
} ?>
</h3>
<hr>
<div>
    <table border=1 class="data-table">
    <thead>
        <th>Place</th>
        <th>Equipes participantes</th>
        <th>Scores</th>
    </thead>
    <?php $place = 1;
    foreach ($equipesPoules[0] as $equipe) {
        echo '<tr><td>' . $place++ . '</td>
            <td>' . $equipe->nomEquipe . '</td>
            <td>' . $equipe->scoreGlobal . '</td></tr>';
    }
    ?>
    </table>
</div>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>