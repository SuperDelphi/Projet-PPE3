<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<?php

$idCompte = isset($user["idCompte"]) ? $user["idCompte"] : "";
$identifiant = isset($user["identifiant"]) ? $user["identifiant"] : "";
$typeCompte = isset($user["typeCompte"]) ? $user["typeCompte"] : "";
$id = $userId;
$title = "Nouvel utilisateur";
$subtitle = "Vous êtes en train de créer un nouvel utilisateur.";

if (!$newForm) {
    if (($c_user["idCompte"] === $id)) {
        $title = "Mon compte";
        $subtitle = "Vous êtes en train de paramétrer votre compte.";
    } else {
        $title = "Mise à jour d'un utilisateur";
        $subtitle = "Vous êtes en train de modifier l'utilisateur <b>" . $user["identifiant"] . "</b>.";
    }
}
?>

    <h2><?= $title ?></h2>
    <h6><?= $subtitle ?></h6>
    <hr>

    <table class="form-table">
        <form method="POST">
            <input type="checkbox" name="newForm" style="display: none" <?= $newForm ? "checked" : "" ?>>
            <tr>
                <td>
                    <label for="identifiant">Nom d'utilisateur</label>
                    <aside>Le nom d'utilisateur doit uniquement comporter<br>des caractères alphanumériques en minuscules.</aside>
                </td>
                <td>
                    <input class="form-control" type="text" id="identifiant" name="identifiant"
                           value="<?= $identifiant ?>" maxlength="32" placeholder="ex : marie4" required>
                    <b class="form-alert" id="id-alert">Caractères alphanumériques uniquement (pas d'espaces) !</b>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password"><?= $newForm ? "Mot" : "Nouveau mot" ?> de passe</label>
                    <aside><?= $newForm ? "" : "(facultatif)" ?></aside>
                </td>
                <td>
                    <input class="form-control" type="password" id="pass1"
                           maxlength="72" placeholder="••••••" <?= $newForm ? "required" : "" ?>>
                </td>
            <tr>
                <td>
                    <label for="password">Confirmer le mot de passe</label>
                    <aside><?= $newForm ? "" : "(facultatif)" ?></aside>
                </td>
                <td>
                    <input class="form-control" type="password" id="pass2" name="password"
                           maxlength="72" placeholder="••••••" <?= $newForm ? "required" : "" ?>>
                    <b class="form-alert" id="password-alert">Le mot de passe doit être identique !</b>
                </td>
            </tr>
            <tr <?= $c_user["idCompte"] === $id ? 'style="display:none"' : "" ?>>
                <td>
                    <label for="typeCompte">Rôle</label>
                </td>
                <td>
                    <select class="form-control" name="typeCompte" required>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type ?>" <?= $type === $typeCompte ? "selected" : "" ?>>
                                <?= ucfirst(mb_strtolower($type)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr <?= $c_user["idCompte"] === $id ? 'style="display:none"' : "" ?>>
                <td>
                    <label for="idPersonne">Propriétaire</label>
                </td>
                <td>
                    <select class="form-control" name="idPersonne" required>
                        <?php foreach ($personnes as $p): ?>

                            <option value="<?= $p["idPersonne"] ?>" <?= $p["idPersonne"] === $idCompte ? "selected" : "" ?>>
                                <?= ucfirst(mb_strtolower($p["prenom"]))
                                . " "
                                . ucfirst(mb_strtolower($p["nom"])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="button primarybuttonWhite"
                       href="<?= BASE_URL . DS . ($c_user["typeCompte"] === "GÉRANT" ? "admin/listeUtilisateur" : "admin/listeChampionnat") ?>">Retour</a>
                    <input id="submitButton" class="primarybuttonBlue" type="submit" value="Enregistrer">
                </td>
            </tr>
        </form>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>

<script>
    // Vérification de l'équivalence du mot de passe

    const idInput = document.getElementById("identifiant");
    const passInput1 = document.getElementById("pass1");
    const passInput2 = document.getElementById("pass2");
    const idAlert = document.getElementById("id-alert");
    const passwordAlert = document.getElementById("password-alert");
    const submitButton = document.getElementById("submitButton");

    let idValid = true, passValid = true;

    idInput.addEventListener("keyup", () => {
        idInput.value = idInput.value.toLowerCase();

        if (/\W+/.test(idInput.value)) {
            idAlert.style.display = "initial";
            idValid = false;
        } else {
            idAlert.style.display = "none";
            idValid = true;
        }
        updateSubmitButtonState([idValid, passValid]);
    });

    passInput2.addEventListener("blur", () => {
        if (passInput1.value === passInput2.value) {
            passwordAlert.style.display = "none";
            passValid = true;
        } else {
            passwordAlert.style.display = "initial";
            passValid = false;
        }
        updateSubmitButtonState([idValid, passValid]);
    });

    function updateSubmitButtonState(booleans) {
        let isInvalid = false;
        booleans.forEach((b) => {
            if (!b) isInvalid = true;
        });
        if (isInvalid)
            submitButton.setAttribute("disabled", "true");
        else
            submitButton.removeAttribute("disabled");
    }
</script>