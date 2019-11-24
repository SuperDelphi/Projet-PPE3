<?php


class AdminController extends Controller
{
    function listeChampionnat()
    {
        $this->redirectNonAuthAndGetUser();

        $this->modChamp = $this->loadModel("Championnat");
        $this->modPoule = $this->loadModel("Poule");

        $groupby = "championnat.idChampionnat";

        $d["championnats"] = $this->modChamp->find([
            "groupby" => $groupby,
            "orderby" => "idChampionnat"
        ]);

        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }

        $d["poules"] = $this->modPoule->find([
            "groupby" => "idChampionnat, nomPoule",
            "orderby" => "nomPoule"
        ]);

        $this->set($d);
        $this->render("listeChampionnat");
    }

    function listeJoueur()
    {
        $this->redirectNonAuthAndGetUser();

        $this->modJoueur = $this->loadModel('Joueur');
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, joueur.scoreGlobale';
        $orderby = 'joueur.scoreGlobale desc';
        $params = array('conditions' => 1, 'projection' => $projection, 'orderby' => $orderby);
        $d['joueurs'] = $this->modJoueur->find($params);

        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function formChampionnat()
    {
        $this->redirectNonAuthAndGetUser();

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

    function listeEquipe(){
        $this->redirectNonAuthAndGetUser();

        $this->modEquipe = $this->loadModel('Equipe');
        $groupby = "equipe.idEquipe";
        $params = array();
        $params = array('groupby' => $groupby);
        $d['equipes'] = $this->modEquipe->find($params);
        if (empty($d['equipes'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("listeEquipe");
    }

    function formEquipe(){
        $this->redirectNonAuthAndGetUser();

        if (isset($_POST["creerEquipe"])) {
            $equipeModele = $this->loadModel("Equipe");
            $nomEquipe = $_POST["nomEquipe"];
            $idClub = $_POST["idClub"];
            $idDivision = $_POST["idDivision"];

            $equipeModele->insertAI(
                    ["nomEquipe", "idClub", "idDivision"], [$nomEquipe, $idClub, $idDivision]
            );
            $this->redirect("/admin/listeEquipe");
        } else {
            $clubModele = $this->loadModel("Club");
            $divisionModele = $this->loadModel("Division");
            
            $d["clubs"] = $clubModele->find();
            $d["divisions"] = $divisionModele->find();
            
            

            $this->set($d);
            $this->render("formEquipe");
        }
}

    function formJournee()
    {
        $this->redirectNonAuthAndGetUser();
    }


    function formRencontre()
    {
        $this->redirectNonAuthAndGetUser();

        if (isset($_POST["creerrencontre"])) {
            $EquipeRencontreModele = $this->loadModel("EquipeRencontre");   

            $EquipeA = $_POST["equipea"];
            $EquipeB = $_POST["equipeb"];
            $ScoreA = $_POST["scorea"];
            $ScoreB = $_POST["scoreb"];
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];

            $EquipeRencontreModele->insertAI(
                ["heure", "date", "lieu", "scoreFinalA", "scoreFinalB", "idJournee", "idArbitre", "idEquipeA", "idEquipeB"],
                [$Heure, $Date, $Lieu, $ScoreA, $ScoreB, $Journee, $Arbitre, $EquipeA, $EquipeB]
            );
            $this->redirect("/admin/listeChampionnat");
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

    function listeJournee($id)
    {
        $this->redirectNonAuthAndGetUser();

        $idChampionnat = trim($id);

        $nbrjournee = 0;
        $j = array();
        $r = array();

        $modJournee = $this->loadModel('Journee');
        $conditions = array('idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $d['journee'] = $modJournee->find($params);
        

        if (empty($d['journee'])) {
            $this->e404('Le calendrier du championnat sera prochainement publié');
        }

        $modChamp = $this->loadModel('Championnat');
        $conditions = array('championnat.idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $d['championnat'] = $modChamp->findFirst($params);
        //var_dump ($d);
        $this->set($d);
        
    }

    function listeRencontre($id)
    {
        $this->redirectNonAuthAndGetUser();

        if (isset($id)) {
            $tmp = explode("-", $id);
            $idChampionnat = trim($tmp[0]);
            $idJournee = trim($tmp[1]);
            $nomPoule = trim($tmp[2]);

            $modRencontre = $this->loadModel('Rencontre');
            $modRencontre->table .= " INNER JOIN poule ON poule.idChampionnat = championnat.idChampionnat";
            $conditions = array('journee.idJournee' => $idJournee, 'nomPoule' => $nomPoule);
            $groupby = 'idEquipeA';
            $params = array('conditions' => $conditions, 'groupby' => $groupby);
            $rencontres = $modRencontre->find($params);
            $d['rencontre'] = $rencontres;
            $r = array();

            $modEquipe = $this->loadModel('Equipe');
            foreach ($rencontres as $rencontre) {
                $conditions = array('equipe.idEquipe' => $rencontre->idEquipeA);
                $params = array('conditions' => $conditions);
                array_push($r, $modEquipe->find($params));
                $conditions = array('equipe.idEquipe' => $rencontre->idEquipeB);
                $params = array('conditions' => $conditions);
                array_push($r, $modEquipe->find($params));
            }
            $d['equipes'] = $r;
            $modChamp = $this->loadModel('Championnat');
            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d['championnat'] = $modChamp->findFirst($params);
            var_dump($d);
            $this->set($d);
        }
    }

    public function listeUtilisateur()
    {
        $this->redirectNonAuthAndGetUser();

        $this->render("listeUtilisateur");
    }

    // Méthode de redirection
    private function redirectNonAuthAndGetUser()
    {
        $compteModele = $this->loadModel("Compte");
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $ip = IP::getUserIP();

            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            if (!($validUser && $validIP)) {
                $this->redirect($redirectURL);
            }
        } else {
            $this->redirect($redirectURL);
        }

        $d["user"] = $compteModele->getByLogin($_SESSION["identifiant"], $_SESSION["hash"], true);
        $this->set($d);

        return $d["user"];
    }
}