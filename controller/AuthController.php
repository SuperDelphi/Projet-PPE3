<?php


class AuthController extends Controller
{
    function auth()
    {
        if (isset($_POST["user"], $_POST["passwd"])) {
            $compteModele = $this->loadModel("Compte");

            $user = Security::hardEscape($_POST["user"]);
            $password = Security::hardEscape($_POST["passwd"]);

            // TODO Ajouter une fonction de filtrage de chaîne de caractères ($user)

            $account = $compteModele->getByLogin($user, $password);
        } else {
            $this->render("login");
        }
    }
}