<?php


class Compte extends Personne
{
    // Les gérants sont représentés par la classe Compte, dont hérite la classe Arbitre.
    var $table = "compte INNER JOIN personne ON compte.idCompte = personne.idPersonne";

    // Retourne un tableau associatif, sinon null. Ne pas confondre le mot de passe ($mdp) et le hash correspondant ($hash).
    public function getByLogin($user, $mdp, $hashMode=false)
    {
        $error = false;
        $accounts = $this->find(["conditions" => [
            "identifiant" => $user
        ]], "TAB");

        if (!$accounts)
            $error = true;
        elseif (!$hashMode && !password_verify($mdp, $accounts[0]["password"])) {
            $error = true;
        } elseif ($hashMode && !($mdp === $accounts[0]["password"])) {
            $error = true;
        }

        return $error ? null : $accounts[0];
    }

    public function userExists($user)
    {
        $accounts = $this->find(["conditions" => [
            "identifiant" => $user
        ]], "TAB");

        return isset($accounts[0]);
    }

}