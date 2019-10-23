<?php


class Compte extends Personne
{
    // Les gérants sont représentés par la classe Compte, dont hérite la classe Arbitre.
    var $table = "compte INNER JOIN personne ON compte.idCompte = personne.idPersonne";

    private $identifiant, $hash, $type;

    // Méthode utilisée par la classe. Ne pas confondre le mot de passe ($mdp) et le hash correspondant ($hash).
    public function __construct($user, $mdp)
    {
        $error = false;
        $account = $this->find(["conditions" => [
            "'identifiant'" => "'$user'"
        ]])[0];

        if (!$account)
            $error = true;

        if (!password_verify($mdp, $account["password"]))
            $error = true;

        if (!$error) {
            parent::__construct(
                $account["nom"],
                $account["prenom"],
                $account["age"],
                $account["sexe"],
                $account["mail"],
                $account["adresse"]
            );
            $this->identifiant = $account["identifiant"];
            $this->hash = $account["password"];
            $this->type = $account["typeCompte"];
        } else {
            parent::__construct("", "", 0, "", "", "");
        }
    }

}