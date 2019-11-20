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
        $this->redirectNonLogged();
        
        if (isset($_POST["creerrencontre"])) {
            $EquipeModele = $this->loadModel("Equipe");

            $EquipeA = $_POST["equipea"];
            $EquipeB = $_POST["equipeb"];
            $ScoreA = $_POST["scorea"];
            $ScoreB = $_POST["scoreb"];
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];


            /*$valid1 = filter_var_array(
                [
                    "lieu" => $Lieu,
                    "scoreFinalA" => $ScoreA,
                    "scoreFinalB" => $ScoreB,
                    "idEquipeA" => $EquipeA,
                    "idEquipeB" => $EquipeB,
                    "idJournee" => $Journee,
                    "idArbitre" => $Arbitre
                ],
                [
                    "lieu" => FILTER_VALIDATE_STRING,
                    "scoreFinalA" => FILTER_VALIDATE_INT,
                    "scoreFinalB" => FILTER_VALIDATE_INT,
                    "idEquipeA" => FILTER_VALIDATE_INT,
                    "idEquipeB" => FILTER_VALIDATE_INT,
                    "idJournee" => FILTER_VALIDATE_INT,
                    "idArbitre" => FILTER_VALIDATE_INT
                ]
            );*/

            /*if ($valid1) {*/
                $EquipeModele->insertAI(
                    ["heure", "date", "lieu", "scoreFinalA", "scoreFinalB", "idJournee", "idArbitre", "idEquipeA", "idEquipeB"],
                    [$Heure, $Date, $Lieu, $ScoreA, $ScoreB, $Journee, $Arbitre, $EquipeA, $EquipeB]
                );
                $this->redirect("/admin/listeChampionnat");
            /*} else {
                $this->redirect("/admin/formRencontre");
            }*/
        } else {
            $EquipeModele = $this->loadModel("Equipe");
            $ArbitreModele = $this->loadModel("Arbitre");
            $JourneeModele = $this->loadModel("Journee");

            $d["equipes"] = $EquipeModele->find();
            $d["arbitres"] = $ArbitreModele->find();
            $d["journees"] = $JourneeModele->find();
            
            $this->set($d);
            $this->render("formRencontre");
        }
        
    }
    

    private function redirectNonLogged() {
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $compteModele = $this->loadModel("Compte");
            $ip = IP::getUserIP();

            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            var_dump($validUser);
            var_dump($validIP);

            if (!($validUser && $validIP)) {
                $this->redirect($redirectURL);
            }
        } else {
            $this->redirect($redirectURL);
        }
    }

    function listeJournee($id){
        $idChampionnat = trim($id);

        $nbrjournee = 0;
        $j=array();
        $r=array();

        $modJournee = $this->loadModel('Journee');
        $conditions = array('idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $journees = $modJournee->find($params);
        foreach ($journees as $journee) {
            $conditions = array('journee.idJournee' => $journee->idJournee, 'championnat.idChampionnat' => $idChampionnat);
            $groupby = 'rencontre.idRencontre';
            $params = array('conditions' => $conditions, 'groupby' => $groupby);
            $r['idJournee'] = $journee->idJournee;
            $r['dateprev'] = $journee->datePrev;
            array_push($j, $r);
            $nbrjournee++;
                //var_dump($r);
        }

        $d['journee'] = $j;
        $d['nbrjournee'] = $nbrjournee;

        if (empty($d['journee'])) {
            $this->e404('Le calendrier du championnat sera prochainement publié');
        }

        $modChamp = $this->loadModel('Championnat');
        $conditions = array('championnat.idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $d['championnat'] = $modChamp->findFirst($params);

        $this->set($d);
    }
}