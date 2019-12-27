<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<?php

$sexes = [
    "M" => "Monsieur",
    "F" => "Madame"
];

$idPersonne = isset($personne["idPersonne"]) ? $personne["idPersonne"] : "";
$nom = isset($personne["nom"]) ? $personne["nom"] : "";
$prenom = isset($personne["prenom"]) ? $personne["prenom"] : "";
$age = isset($personne["age"]) ? intval($personne["age"]) : -1;
$sexe = isset($personne["sexe"]) ? $personne["sexe"] : $sexes[ArrayWizard::arrayKeyFirst($sexes)];
$mail = isset($personne["mail"]) ? $personne["mail"] : "";
$adresse = isset($personne["adresse"]) ? $personne["adresse"] : "";
$title = "Nouvelle personne";
$subtitle = "Vous êtes en train d'ajouter une nouvelle personne.";

if (!$newForm) {
    $title = "Mise à jour d'une personne";
    $subtitle = "Vous êtes en train de mettre à jour l'identité de <b>" . $personne["prenom"]
        . " " .  ucfirst(mb_strtolower($personne["nom"])) . "</b>.";
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
                <label for="prenom">Prénom</label>
            </td>
            <td>
                <input class="form-control" type="text" id="prenom" name="prenom"
                       value="<?= $prenom ?>" maxlength="64" placeholder="ex : Jean" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="nom">Nom</label>
            </td>
            <td>
                <input class="form-control" type="text" id="nom" name="nom"
                       value="<?= $nom ?>" maxlength="64" placeholder="ex : Dupont" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="sexe">Civilité</label>
            </td>
            <td>
                <?php foreach ($sexes as $s => $label): ?>
                    <div class="radio-container">
                        <input class="form-check-inline" type="radio" name="sexe"
                               id="<?= "sexe-" . $s ?>" value="<?= $s ?>" <?= $s === $sexe ? "checked" : "" ?>>
                        <label for="<?= "sexe-" . $s ?>"><?= $label ?></label>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="age">Âge</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <select class="form-control" id="age" name="age" required>
                    <option value="-1" <?= $newForm ? "selected" : "" ?>>Non spécifié</option>
                    <?php for ($i=$ageBounds[0];$i<$ageBounds[1]+1;$i++): ?>
                    <option value="<?= $i ?>" <?= $i === $age ? "selected" : "" ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="mail">E-mail</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input class="form-control" id="mail" name="mail" type="email"
                       value="<?= $mail ?>" maxlength="64" placeholder="ex : jean.dupont@gmail.com">
            </td>
        </tr>
        <tr>
            <td>
                <label for="adresse">Adresse complète</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input class="form-control" id="adresse" name="adresse" type="text"
                       value="<?= $adresse ?>" maxlength="128" placeholder="ex : 123, Av. de la République 12345 Saint-Jean">
            </td>
        </tr>
        <tr>
            <td>
                <a class="button primarybuttonWhite"
                   href="<?= BASE_URL . DS . "admin" . DS . "listePersonne" ?>">Retour</a>
                <input id="submitButton" class="primarybuttonBlue" type="submit" value="Enregistrer">
            </td>
        </tr>
    </form>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>