<?php $genderSuffix = $c_user["sexe"] === "M" ? "" : "e" ?>

<div id="admin-menu" class="container-fluid col-lg-3">
    <div class="welcome-container">
        <span class="welcome-message">Session de <b
                    style='color: #00379a'><?= ucfirst(mb_strtolower($c_user["prenom"])) . " " . ucfirst(mb_strtolower($c_user["nom"])) ?></b></span>
        <br>
        <span>Vous êtes connecté<?= $genderSuffix ?> en tant
            <?= $c_user["typeCompte"] === "GÉRANT" ? "que <b style='color: #ffa500'>"
                . ucfirst(mb_strtolower($c_user["typeCompte"])) . $genderSuffix . "</b>" : "qu'<b style='color: #00a800'>"
                . ucfirst(mb_strtolower($c_user["typeCompte"])) . "</b>" ?>.</span>
    </div>
    <h4 class="admin-menu-title">Panel de gestion</h4>
    <a href="<?= BASE_URL . DS ?>admin/listeChampionnat">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-home"></i></div>
            <div class="col nav-item">Tableau de bord</div>
        </div>
    </a>
    <hr>
    <a href="<?= BASE_URL . DS ?>admin/listeEquipe">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-users"></i></div>
            <div class="col nav-item">Équipes</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/listeJoueur">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-table-tennis"></i></div>
            <div class="col nav-item">Joueurs</div>
        </div>
    </a>
    <hr>
    <?php if ($c_user["typeCompte"] === "GÉRANT"): ?>
        <a href="<?= BASE_URL . DS ?>admin/listeUtilisateur">
            <div class="row mx-0">
                <div class="nav-item icon-container"><i class="fas fa-users-cog"></i></div>
                <div class="col nav-item">Gestion des utilisateurs</div>
            </div>
        </a>
    <?php endif; ?>
    <a href="<?= BASE_URL . DS ?>admin/settings">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-user-circle"></i></div>
            <div class="col nav-item">Mon compte</div>
        </div>
    </a>
    <hr>
    <a class="disconnect-link" href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-power-off"></i></div>
            <div class="col nav-item">Déconnexion</div>
        </div>
    </a>
</div>