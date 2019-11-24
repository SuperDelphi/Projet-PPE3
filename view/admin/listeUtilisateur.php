<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Gestion des utilisateurs</h2>
    <h6>Vous pouvez gérer les utilisateurs (Arbitres/Gérants) de l'application SANA depuis cette interface.</h6>
    <hr>

    <table class="data-table left">
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Propriétaire</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user["identifiant"] ?></td>
                <td><?= $user["typeCompte"] === "GERANT" ? "Gérant" : "Arbitre" ?></td>
                <td><?= ucfirst(strtolower($user["prenom"])) . " " . ucfirst(strtolower($user["nom"])) ?></td>
                <td><?= $user["mail"] ? $user["mail"] : "-" ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>