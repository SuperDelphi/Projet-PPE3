<?php


class AuthController extends Controller
{
    function auth()
    {
        $error = false;
        if (isset($_POST["user"], $_POST["passwd"])) {
            $compteModele = $this->loadModel("Compte");

            $user = Security::hardEscape($_POST["user"]);
            $password = Security::hardEscape($_POST["passwd"]);

            // TODO Ajouter une fonction de filtrage de chaîne de caractères ($user)

            $account = $compteModele->getByLogin($user, $password);

            if (!$account) {
                $error = true;
                $this->render("login");
            } else {
                Session::login($user, $account["password"], $account["typeCompte"]);
                $this->render("/admin/listeChampionnat");
            }
        } else {
            $this->render("login");
        }
    }
}