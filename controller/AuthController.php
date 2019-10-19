<?php




class AuthController extends Controller
{
    function auth()
    {
        if (isset($_POST["user"], $_POST["passwd"])) {
            $user = Security::hardEscape($_POST["user"]);
            $password = Security::hardEscape($_POST["passwd"]);

            // TODO Ajouter une fonction de filtrage de chaîne de caractères ($user)
        } else {
            $this->render("login");
        }
    }
}