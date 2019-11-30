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
            $account = $compteModele->getByLogin($user, $password);

            if (!$account) {
                $error = true;
                $this->set(["info" => "Identifiants incorrects."]);
                $this->render("login");
            } else {
                Session::login($user, $account["password"], $account["typeCompte"]);
                $this->redirect("/admin/listeChampionnat");
            }
        }
    }

    function logout()
    {
        Session::destruct();
        $this->redirect("/championnat/liste");
    }
}