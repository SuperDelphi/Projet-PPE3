<?php


class AdminController extends Controller
{
    function listeChampionnat()
    {
        $this->redirectNonLogged();
        $this->modChamp = $this->loadModel("Championnat");
        $groupby = "championnat.idChampionnat";
        $params = array('groupby' => $groupby);
        $d['championnats'] = $this->modChamp->find($params);

        $this->set($d);
        $this->render("listeChampionnat");
    }

//    function listeRencontre($id) {
//        $this->redirectNonLogged();
//        $this->modChamp = $this->loadModel("Championnat");
//        $this->modJournee = $this->loadModel("Journee");
//        $this->modRencontre = $this->loadModel("Rencontre");
//
//        $champ = $this->modChamp->find([
//            "conditions" =>
//        ]);
//
//        $rencontres = $this->modRencontre->find(array(
//            "conditions" => ["idRencontre" => $id],
//            "orderby" => "date ASC"
//        ));
//
//
//    }

    function formChampionnat()
    {
        $this->redirectNonLogged();
        if (isset($_POST["creerChampionnat"])) {
            $championnatModele = $this->loadModel("Championnat");

            $nomChampionnat = $_POST["nomChampionnat"];
            $typeChampionnat = $_POST["typeChampionnat"];
            $nombreJournees = $_POST["nombreJournee"]; // TODO S'occuper de ça
            $idDivision = $_POST["idDivision"];

            $valid1 = filter_var_array(
                [
                    "nomChampionnat" => $nomChampionnat,
                    "typeChampionnat" => $typeChampionnat,
                    "nombreJournees" => $nombreJournees,
                    "idDivision" => $idDivision
                ],
                [
                    "nomChampionnat" => FILTER_SANITIZE_STRING,
                    "typeChampionnat" => FILTER_SANITIZE_STRING,
                    "nombreJournees" => FILTER_VALIDATE_INT,
                    "idDivision" => FILTER_VALIDATE_INT
                ]
            );

            $nomChampionnat = Security::shorten($nomChampionnat, 64);

            $typesChampionnat = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

            $valid2 = in_array($typeChampionnat, $typesChampionnat);

            if ($valid1 && $valid2) {
                $championnatModele->insertAI(
                    ["nomChampionnat", "typeChampionnat", "idDivision"],
                    [$nomChampionnat, $typeChampionnat, $idDivision]
                );
                $this->redirect("/admin/listeChampionnat");
            } else {
                $this->redirect("/admin/formChampionnat");
            }
        } else {
            $championnatModele = $this->loadModel("Championnat");
            $divisionModele = $this->loadModel("division");

            $d["divisions"] = $divisionModele->find();
            $d["typesChampionnat"] = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

            $this->set($d);
            $this->render("formChampionnat");
        }
    }
    
    function formRencontre() {

    }
    

    private function redirectNonLogged() {
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $compteModele = $this->loadModel("Compte");
            $ip = IP::getUserIP();

            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            if (!($validUser && $validIP)) {
                $this->redirect($redirectURL);
            }
        } else {
            $this->redirect($redirectURL);
        }
    }
}