<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Gestion des utilisateurs</h2>
    <h6>Vous pouvez gérer les utilisateurs (Arbitres/Gérants) de l'application SANA depuis cette interface.</h6>
    <hr>

    <a class="button primarybuttonBlue" href="<?= BASE_URL . DS . "admin" . DS . "formUtilisateur" ?>">
        <i class="fas fa-plus fa-sm"></i>&nbsp Nouvel utilisateur
    </a>

    <table class="data-table left sober">
        <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Rôle</th>
            <th>Propriétaire</th>
            <th>E-mail</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
        <?php $isMyAccount = $user["idCompte"] === $u["idCompte"]; ?>
            <tr <?= $isMyAccount ? "class=\"highlighted\"" : "" ?>>
                <td><?= $u["identifiant"] ?></td>
                <td><?= $u["typeCompte"] === "GERANT" ?
                        "<b class='label-gerant'>Gérant</b>" : "<b class='label-arbitre'>Arbitre</b>" ?></td>
                <td><?= ucfirst(strtolower($u["prenom"])) . " " . ucfirst(strtolower($u["nom"])) ?></td>
                <td><?= $u["mail"] ? $u["mail"] : "Aucune" ?></td>
                <td class="row">
                    <a class="button primarybuttonBlue col-lg text-center" href="<?= BASE_URL . DS . "admin" . DS . "formUtilisateur" ?>">Gérer</a>
                    <a class="button dangerbutton col-lg text-center" <?= $isMyAccount ? "disabled=\"true\"" : "" ?>
                       href="<?= !$isMyAccount ? BASE_URL . DS . "admin" . DS . "deleteUtilisateur" : "#" ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>