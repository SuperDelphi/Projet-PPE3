<?php $genderSuffix = $user["sexe"] === "M" ? "" : "e" ?>

<div id="admin-menu" class="container-fluid col-lg-3 col-md-4">
    <div class="welcome-container">
        <span class="welcome-message">Session de <b style='color: #00379a'><?= ucfirst(strtolower($user["prenom"])) . " " . ucfirst(strtolower($user["nom"]))?></b></span>
        <br>
        <span>Vous êtes connecté<?= $genderSuffix ?> en tant
            <?= $user["typeCompte"] === "GERANT" ? "que <b style='color: #00ced1'>Gérant$genderSuffix</b>" : "qu'<b style='color: #00ced1'>Arbitre</b>" ?>.</span>
    </div>
    <h4 class="admin-menu-title">Panel de gestion</h4>
    <a href="<?= BASE_URL . DS ?>admin/listeChampionnat">
        <div class="row mx-0">
            <div class="nav-item"><i class="fas fa-home"></i></div>
            <div class="col nav-item">Tableau de bord</div>
        </div>
    </a>
    <hr>
    <a href="<?= BASE_URL . DS ?>admin/listeEquipe">
        <div class="row mx-0">
            <div class="nav-item"><i class="fas fa-users"></i></div>
            <div class="col nav-item">Équipes</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/listeJoueur">
        <div class="row mx-0">
            <div class="nav-item"><i class="fas fa-table-tennis"></i></div>
            <div class="col nav-item">Joueurs</div>
        </div>
    </a>
    <hr>
    <?php if ($user["typeCompte"] === "GERANT"): ?>
    <a href="<?= BASE_URL . DS ?>admin/listeUtilisateur">
        <div class="row mx-0">
            <div class="nav-item"><i class="fas fa-users-cog"></i></div>
            <div class="col nav-item">Gestion des utilisateurs</div>
        </div>
    </a>
    <hr>
    <?php endif; ?>
    <a class="disconnect-link" href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="nav-item"><i class="fas fa-power-off"></i></div>
            <div class="col nav-item">Déconnexion</div>
        </div>
    </a>
</div>