<form class="form-horizontal" method="post" action="<?= BASE_URL . DS ?>auth/login">
    <fieldset>

        <!-- Form Name -->
        <legend>Connexion</legend>
        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Identifiant</label>
            <div class="col-md-1">
                <input id="user" name="user" class="form-control input-md" type="text"
                       value="<?= (isset($compte->user) ? $compte->user : '') ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Mot de passe</label>
            <div class="col-md-4">
                <input id="password" name="passwd" placeholder="••••••••" class="form-control input-md"
                       type="password" value="<?= (isset($compte->password) ? $compte->password : '') ?>">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="primarybuttonWhite">Connexion</button>
            </div>
        </div>

    </fieldset>
</form>

<div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div>
