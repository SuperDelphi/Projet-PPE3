<h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . ' ' . $championnat->nomDivision; ?></h2>
<h3>Classement des équipes</h3>
<div>
<?php if (isset($poule)) { echo '<h3>Poule '. $poule[0]->nomPoule . '</h3>';} ?>
    <table border=1 class="data-table">
    <thead>
        <th>Place</th>
        <th>Equipes participantes</th>
        <th>Scores</th>
    </thead>
    <?php $place = 1;
    if (isset($poule)) {
        foreach ($equipesPoules[0] as $equipe) {
            echo '<tr><td>' . $place++ . '</td>
            <td>' . $equipe->nomEquipe . '</td>
            <td>' . $equipe->scoreGlobal . '</td></tr>';
        }
    } else {
        foreach ($equipesPoules[0] as $equipe) {
            echo '<tr><td>' . $place++ . '</td>
            <td>' . $equipe->nomEquipe . '</td>
            <td>' . $equipe->scoreGlobal . '</td></tr>';
        }
    }
    ?>
    </table>
</div>