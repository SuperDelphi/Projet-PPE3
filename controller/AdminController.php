<?php


class AdminController extends Controller
{
    function listeChampionnat()
    {
        $this->render("listeChampionnat");
    }

    function formChampionnat()
    {
        if (isset($_POST["creerChampionnat"])) {
            $championnatModele = $this->loadModel("Championnat");

            $nomChampionnat = $_POST["nomChampionnat"];
            $typeChampionnat = $_POST["typeChampionnat"];
            $nombreJournees = $_POST["nombreJournee"]; // TODO S'occuper de ça
            $idDivision = $_POST["idDivision"];

            $championnatModele->insertAI(
                ["nomChampionnat", "typeChampionnat", "idDivision"],
                [$nomChampionnat, $typeChampionnat, $idDivision]
            );

            $this->render("listeChampionnat");
        } else {
            $divisionModele = $this->loadModel("division");
            $d["divisions"] = $divisionModele->find();
            $this->set($d);
            $this->render("formChampionnat");
        }
    }
}