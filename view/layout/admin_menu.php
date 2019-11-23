<?php $genderSuffix = $user["sexe"] === "M" ? "" : "e" ?>

<div class="container-fluid admin-menu col-lg-3 col-md-4">
    <div class="welcome-container">
        <span class="welcome-message">Session de <b><?= ucfirst(strtolower($user["prenom"])) . " " . ucfirst(strtolower($user["nom"]))?></b></span>
        <br>
        <span>Vous êtes connecté<?= $genderSuffix ?> en tant
            <?= $user["typeCompte"] === "GERANT" ? "que <b>Gérant$genderSuffix</b>" : "qu'<b>Arbitre</b>" ?>.</span>
    </div>
    <h4 class="admin-menu-title">Panel de gestion</h4>
    <a href="<?= BASE_URL . DS ?>admin/formRencontre">
        <div class="row mx-0">
            <div class="col nav-item">Nouvelle rencontre</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/formJournee">
        <div class="row mx-0">
            <div class="col nav-item">Nouvelle journée</div>
        </div>
    </a>
     <a href="<?= BASE_URL . DS ?>admin/formEquipe">
        <div class="row mx-0">
            <div class="col nav-item">Nouvelle équipe</div>
        </div>
    </a>
    <hr>
    <a href="<?= BASE_URL . DS ?>admin/listeEquipe">
        <div class="row mx-0">
            <div class="col nav-item">Équipes</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/listeJoueur">
        <div class="row mx-0">
            <div class="col nav-item">Joueurs</div>
        </div>
    </a>
    <hr>
    <a href="<?= BASE_URL . DS ?>admin/listeUtilisateur">
        <div class="row mx-0">
            <div class="col nav-item">Utilisateurs</div>
        </div>
    </a>
    <hr>
    <a class="disconnect-link" href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="col nav-item">Déconnexion</div>
        </div>
    </a>
</div>