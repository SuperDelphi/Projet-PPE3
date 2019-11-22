<div class="container-fluid admin-menu col-lg-2">
    <h4 class="admin-menu-title">Panel de gestion</h4>
    <a href="<?= BASE_URL . DS ?>admin/formChampionnat">
        <div class="row mx-0">
            <div class="col nav-item">Nouveau championnat</div>
        </div>
    </a>
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
    <hr>
    <a href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="col nav-item">Équipes</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="col nav-item">Joueurs</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>auth/logout">
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