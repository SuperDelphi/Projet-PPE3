<?php


class AuthController extends Controller
{
    function login()
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
//            $this->redirect("/auth/login");
                $this->render("login");
            } else {
                Session::login($user, $account["password"], $account["typeCompte"]);
                $this->redirect("/admin/listeChampionnat");
            }
        } else {
//            $this->redirect("/auth/login");
            $this->render("login");
        }
    }

    function logout()
    {
        Session::destruct();
//        $this->redirect("/joueur/liste");
        $this->render("/joueur/liste");
    }
}