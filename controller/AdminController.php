<?php


class AdminController extends Controller
{
    private $auth_levels = [
        "GUEST" => 0,
        "ARBITRE" => 1,
        "GÉRANT" => 2
    ];

    function listeChampionnat()
    {
        $this->filterAndGetUser(1);

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
        $this->filterAndGetUser(1);

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
        $this->filterAndGetUser(2);

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

    function listeEquipe()
    {
        $this->filterAndGetUser(1);

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

    function formEquipe()
    {
        $this->filterAndGetUser(1);

        if (isset($_POST["creerEquipe"])) {
            $equipeModele = $this->loadModel("Equipe");
            $nomEquipe = $_POST["nomEquipe"];
            $idClub = $_POST["idClub"];
            $idDivision = $_POST["idDivision"];

            $equipeModele->insertAI(
                ["nomEquipe", "idClub", "idDivision"],
                [$nomEquipe, $idClub, $idDivision]
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

    function formJoueur()
    {
        $this->filterAndGetUser(1);

        if (isset($_POST["creerJoueur"])) {
            $joueurModele = $this->loadModel("Joueur");
            $joueurModele->table = "joueur";
            $personneModele = $this->loadModel("Personne");
            $nom = $_POST["nom"];
            $prenom = $_POST['prenom'];
            $sexe = $_POST['sexe'];
            $licence = $_POST['licence'];
            $scoreGlobale = $_POST['scoreGlobale'];
            $idEquipe = $_POST["idEquipe"];

            $idPersonne = $personneModele->insertAI(
                ["nom", "prenom", "sexe"],
                [$nom, $prenom, $sexe]
            );

            $joueurModele->insertAI(
                ["idJoueur", "licenceJoueur", "visible", "idEquipe", "scoreGlobale"],
                [$idPersonne, $licence, 1, $idEquipe, $scoreGlobale]
            );
            $this->redirect("/admin/listeJoueur");
        } else {
            $equipeModele = $this->loadModel("equipe");

            $d["equipes"] = $equipeModele->find();

            $this->set($d);
            $this->render("formJoueur");
        }
    }

    function formJournee()
    {
        $this->filterAndGetUser(1);
    }


    function formRencontre()
    {
        $this->filterAndGetUser(2);

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
        } elseif (isset($_POST["modifierrencontre"])) {
            $RencontreModele = $this->loadModel("Rencontre");
            $RencontreModele->table = "rencontre";

            $idRencontre = $_GET['idRencontre'];
            $EquipeA = $_POST["equipea"];
            $EquipeB = $_POST["equipeb"];
            $ScoreA = $_POST["scorea"];
            $ScoreB = $_POST["scoreb"];
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];

            $donnees = array("heure" => $Heure, "date" => $Date, "lieu" => $Lieu, "scoreFinalA" => $ScoreA, "scoreFinalB" => $ScoreB, "idJournee" => $Journee, "idArbitre" => $Arbitre, "idEquipeA" => $EquipeA, "idEquipeB" => $EquipeB);
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('donnees' => $donnees, 'conditions' => $conditions);
            echo 'ok';
            $RencontreModele->update($params);
            $this->redirect("/admin/listeChampionnat");
        } elseif (isset($_GET['idRencontre'])) {
            $idRencontre = $_GET['idRencontre'];
            $this->modRenc = $this->loadModel('Rencontre');
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $rencontre = $this->modRenc->find($params);
            $d['rencontre'] = $rencontre;

            $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");

            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find();
            $d["journees"] = $JourneeModele->find();

            $this->set($d);
            $this->render("formRencontre");
        } else {
            $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");

            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find();
            $d["journees"] = $JourneeModele->find();

            $this->set($d);
            $this->render("formRencontre");
        }
    }

    function listeJournee()
    {
        $this->filterAndGetUser(1);

        if (isset($_GET['idchampionnat'])) {
            $idChampionnat = $_GET['idchampionnat'];

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
        } else {
            $this->e404('Page introuvable. Nous nous excusons de cet incident.');
        }
    }

    function listeRencontre()
    {
        $this->filterAndGetUser(1);

        if (isset($_GET['idchampionnat'])) {
            $idChampionnat = $_GET['idchampionnat'];
            $idJournee = $_GET['idjournee'];
            $nomPoule = $_GET['nompoule'];

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
            //var_dump($d);
            $this->set($d);
        } else {
            $this->e404('Aucune rencontre trouvée. Nous nous execusons de cet incident.');
        }
    }

    public function listeUtilisateur()
    {
        $this->filterAndGetUser(2);

        $compteModele = $this->loadModel("Compte");

        $users = $compteModele->find([
            "orderby" => "compte.identifiant"
        ], "TAB");

        $this->set(["users" => $users]);

        $this->render("listeUtilisateur");
    }

    public function deleteUtilisateur($id)
    {
        $c_user = $this->filterAndGetUser(2);

        $compteModele = $this->loadModel("Compte");

        $user = $compteModele->find([
            "conditions" => ["idCompte" => $id]
        ], "TAB");

        if (!$user) {
            $this->e404("Cet utilisateur n'existe pas.");
        } elseif ($user[0]["idCompte"] === $c_user["idCompte"]) {
            $this->e404("Vous ne pouvez pas supprimer votre propre compte.");
        }

        $user = $user[0];

        $this->set(["user" => $user]);

        if (isset($_POST["passwd"])) {
            $password = Security::hardEscape($_POST["passwd"]);

            $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

            if (!$validUser) {
                $this->set(["info" => "Mot de passe incorrect."]);
            } else {
                // Suppression de l'utilisateur

                $arbitreModele = $this->loadModel("Arbitre");

                if ($user["typeCompte"] === "ARBITRE") {
                    $arbitreModele->delete([
                        "conditions" => ["idArbitre" => $id]
                    ]);
                }

                $compteModele->delete([
                    "conditions" => ["idCompte" => $id]
                ]);

                $this->redirect("/admin/listeUtilisateur");
            }
        }
    }

    public function formUtilisateur($id)
    {
        $this->filterAndGetUser(2);

        $personneModele = $this->loadModel("Personne");
        $compteModele = $this->loadModel("Compte");
        $arbitreModele = $this->loadModel("Arbitre");

        $comptes = $compteModele->find([], "TAB");

        $personnes = $personneModele->find([
            "orderby" => "personne.prenom ASC"
        ], "TAB");

        $newForm = !isset($id);
        $types = Parser::getEnumValuesFromRaw($compteModele->getColumnFromTable("compte", "typeCompte")["Type"]);

        $filteredPersonnes = [];

        foreach ($personnes as $p) {
            $alreadyHasAnAccount = false;
            foreach ($comptes as $c) {
                if ($p["idPersonne"] === $c["idCompte"]) {
                    if (!(!$newForm && ($id === $p["idPersonne"]))) $alreadyHasAnAccount = true;
                }
            }
            if (!$alreadyHasAnAccount) array_push($filteredPersonnes, $p);
        }

        $d["newForm"] = $newForm;
        $d["types"] = $types;
        $d["personnes"] = $filteredPersonnes;

        if ($newForm) {
            // Nouvel utilisateur
            if (isset($_POST["identifiant"], $_POST["password"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = Security::shorten(Security::hardEscape($_POST["identifiant"]), 32);
                $password = Security::shorten($_POST["password"], 72);

                if (preg_match("/\W+/", $password))
                    $this->redirect("admin/listeUtilisateur");

                $typeCompte = $_POST["typeCompte"];
                $idPersonne = $_POST["idPersonne"];

                $compteModele->insert(
                    ["idCompte", "identifiant", "password", "typeCompte"],
                    [$idPersonne, $identifiant, Security::hash($password), $typeCompte]
                );

                if ($typeCompte === "ARBITRE") {
                    // Création d'une occurrence Arbitre
                    $arbitreModele->insert(["idArbitre"], [$idPersonne]);
                }

                $this->redirect("/admin/listeUtilisateur");
            }
        } else {
            // Mise à jour d'un utilisateur
            $user = $compteModele->find([
                "conditions" => ["idCompte" => $id]
            ], "TAB");

            if (!$user)
                $this->e404("Cet utilisateur n'existe pas.");
            elseif (!$personnes)
                $this->e404("Il n'existe aucune personne dans la base de données.");

            $d["user"] = $user[0];

            if (isset($_POST["identifiant"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = Security::shorten(Security::hardEscape($_POST["identifiant"]), 32);
                $typeCompte = $_POST["typeCompte"];
                $idPersonne = $_POST["idPersonne"];

                $donneesCompte = [
                    "idCompte" => $idPersonne,
                    "identifiant" => $identifiant,
                    "typeCompte" => $typeCompte
                ];

                if (isset($_POST["password"]) && strlen($_POST["password"]) > 0) {
                    $password = Security::shorten($_POST["password"], 128);
                    if (preg_match("/\W+/", $password)) {
                        $this->redirect("admin/listeUtilisateur");
                    } else
                        $donneesCompte["password"] = Security::hash($password);
                }

                if ($typeCompte === "ARBITRE" && $idPersonne !== $id) {
                    $arbitreModele->update([
                        "donnees" => [
                            "idArbitre" => $idPersonne
                        ],
                        "conditions" => [
                            "idArbitre" => $id
                        ]
                    ]);
                } else {
                    $arbitreModele->delete([
                        "conditions" => ["idArbitre" => $id]
                    ]);
                }

                $compteModele->update([
                    "donnees" => $donneesCompte,
                    "conditions" => [
                        "idCompte" => $id
                    ]
                ]);

                $this->redirect("/admin/listeUtilisateur");
            }
        }

        $this->set($d);

        $this->render("formUtilisateur");
    }

    // Méthode de filtrage
    private function filterAndGetUser($minAuthLevel = 1)
    {
        $compteModele = $this->loadModel("Compte");
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $ip = IP::getUserIP();
            $accountType = $_SESSION["type"];

            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            if (isset($this->auth_levels["$accountType"])) {
                $validAuthorization = $this->auth_levels["$accountType"] >= $minAuthLevel;
            } else {
                $validAuthorization = false;
            }

            if (!($validUser && $validIP && $validAuthorization)) {
                Session::destruct();
                $this->redirect($redirectURL);
            }
        } else {
            Session::destruct();
            $this->redirect($redirectURL);
        }

        $d["c_user"] = $compteModele->getByLogin($_SESSION["identifiant"], $_SESSION["hash"], true);
        $this->set($d);

        return $d["c_user"];
    }
}