<section class="row d-flex justify-content-center mx-0">
    <div class="form-container col-lg-4 col-md-7 col-sm-9">
        <form class="form-horizontal" method="post" action="<?= BASE_URL . DS ?>auth/login">
            <fieldset>

                <!-- Form Name -->
                <h2>Connectez-vous !</h2>
                <!-- Text input-->
                <br>
                <div class="form-group">
                    <label class="col control-label" for="textinput">Identifiant</label>
                    <div class="col">
                        <input id="user" name="user" class="form-control input-md" type="text"
                               value="<?= (isset($compte->user) ? $compte->user : '') ?>" autofocus required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label" for="textinput">Mot de passe</label>
                    <div class="col">
                        <input id="password" name="passwd" placeholder="••••••••" class="form-control input-md"
                               type="password" value="<?= (isset($compte->password) ? $compte->password : '') ?>" required>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col control-label" for="singlebutton"></label>
                    <div class="col">
                        <button id="singlebutton" name="singlebutton" class="primarybuttonBlue">Connexion</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div>
    </div>
</section>