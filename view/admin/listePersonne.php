<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Liste des personnes</h2>
    <h6>Vous pouvez gérer les personnes existant en tant que joueur et/ou Arbitre/Gérant.</h6>
    <hr>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formPersonne" ?>"
       class="button primarybuttonBlue"><i class="fas fa-plus fa-sm"></i>&nbsp Nouvelle personne</a>

    <br>

    <div class="data-table">
    <?php foreach ($personnes as $p) : ?>
    <?php $isMyAccount = $c_user["idCompte"] === $p["idPersonne"]; ?>
    <div class="person-container col-lg-9 col-md-10 col row">
        <div class="col">
            <div class="row">
                <div class="col-lg-9 col-6">
                    <div class="row">
                        <div class="col px-0">
                    <span><?= "<b>" . mb_strtoupper($p["nom"]) . " "
                        . $p["prenom"] . "</b>"
                        . ($p["age"] > 0 ? ("<span style='opacity: 0.5'> • " . $p["age"] . " ans</span>") : "") ?></span>
                            &nbsp
                            <i class="fas fa-<?= $p["sexe"] === "M" ? "mars" : "venus" ?>"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row p-1"><span class="data-indicator">E-mail</span><span><?= $p["mail"] ? $p["mail"] : "-" ?></span></div>
                            <div class="row p-1"><span class="data-indicator">Adresse</span><span><?= $p["adresse"] ? $p["adresse"] : "-" ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="button-container col-lg-3 col-6">
                    <div class="row">
                        <div class="col">
                            <a class="button primarybuttonBlue col-lg text-center" href="<?= BASE_URL . DS . "admin" . DS . "formPersonne/" . $p["idPersonne"] ?>">Gérer</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a class="button dangerbutton col-lg text-center" <?= $isMyAccount ? "disabled=\"true\"" : "" ?>
                               href="<?= !$isMyAccount ? BASE_URL . DS . "admin" . DS . "deletePersonne/" . $p["idPersonne"] : "#" ?>">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>