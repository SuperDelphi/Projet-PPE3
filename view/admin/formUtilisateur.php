<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2><?= $newForm ? "Nouvel utilisateur" : "Mise à jour d'un utilisateur" ?></h2>
    <hr>

    <table class="form-table">
        <form>
            <tr>
                <td>
                    <label for="identifiant">Nom d'utilisateur</label>
                </td>
                <td>
                    <input class="form-control" type="text" name="identifiant" maxlength="32" placeholder="ex : marie4" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Mot de passe</label>
                </td>
                <td>
                    <input class="form-control" type="password" name="password" maxlength="128" placeholder="••••••••" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="typeCompte">Rôle</label>
                </td>
                <td>
                    <select class="form-control" name="typeCompte" required>
                        <?php foreach ($types as $type): ?>
                        <option value="<?= $type ?>"><?= ucfirst(mb_strtolower($type)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </form>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>