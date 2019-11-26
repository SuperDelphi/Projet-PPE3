<section class="row d-flex justify-content-center mx-0">
    <div class="form-container col-lg-4 col-md-7 col-sm-9">

        <form class="form-horizontal" method="POST">
            <fieldset>

                <!-- Form Name -->
                <h2>Supprimer cet utilisateur ?</h2>
                <h6>Vous vous apprêtez à supprimer l'utilisateur <b><?= $user["identifiant"] ?></b>. Cette action est irréversible.</h6>
                <!-- Text input-->
                <br>

                <div class="form-group">
                    <label class="control-label" for="textinput">Saisissez votre mot de passe :</label>
                    <div>
                        <input id="password" name="passwd" placeholder="••••••••" class="form-control input-md"
                               type="password" value="<?= (isset($compte->password) ? $compte->password : '') ?>" autofocus required>
                    </div>
                </div>

                <div class="alert-info" style="<?= (!isset($info) ? "display:none" : "") ?>" name="info"><?= (isset($info) ? $info : "") ?></div>

                <!-- Button -->
                <div class="form-group">
                    <label class="control-label" for="singlebutton"></label>
                    <div>
                        <a id="singlebutton" href="<?= BASE_URL . DS . "admin/listeUtilisateur" ?>" class="button primarybuttonWhite">Annuler</a>
                        <button id="singlebutton" name="singlebutton" class="dangerbutton"><i class="fas fa-exclamation-triangle"></i>&nbsp Supprimer</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
</section>