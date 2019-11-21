<!-- Lien provisoire -->
<a href="<?= BASE_URL . DS ?>simulationJoueur/formSimulation">Nouvelle Simulation</a>

<br>
<form method="post" action="formSimulation.php">
    <table class="data-table">
        <thead>
            <tr>
                <th>JoueurA</th>
                <th>Classement Joueur A</th>
                <th>JoueurB</th>
                <th>Classement Joueur B</th>
            </tr>
            <tr>
                <th> <?php echo $nomJoueurA ?></th>
                <th> <?php echo $classementJoueurA ?></th>
                <th> <?php echo $nomJoueurB ?></th>
                <th> <?php echo $classementJoueurB ?></th>
            </tr>

        </thead>
    </table>
</form>