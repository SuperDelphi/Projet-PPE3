<?php


class AdminController extends Controller
{
    private $auth_levels = [
        "GUEST" => 0,
        "ARBITRE" => 1,
        "GÉRANT" => 2
    ];

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
            $nombreJournees = $_POST["nombreJournee"];
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
            $modJournee = $this->loadModel("Journee");
            $modChamp = $this->loadModel("Championnat");
            $modPoules = $this->loadModel("Poule");

            $idChampionnat = $_GET['idchampionnat'];

            $conditions = array('idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d['journee'] = $modJournee->find($params);

            if (empty($d['journee'])) {
                $this->e404('Le calendrier du championnat sera prochainement publié.');
            }

            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d['championnat'] = $modChamp->findFirst($params);

            // Vérification de la présence de plusieurs poules dans le championnat
            $poules = $modPoules->find(["conditions" => ["idChampionnat" => $idChampionnat]], "TAB");
            $d["hasPoules"] = count($poules) !== 0;

            $this->set($d);
        } else {
            $this->e404('Page introuvable. Nous nous excusons pour cet incident.');
        }
    }

    function listeRencontre()
    {
        $this->filterAndGetUser(1);

        if (isset($_GET['idchampionnat'])) {
            // Récupération des modèles
            $modRencontre = $this->loadModel("Rencontre");
            $modJournee = $this->loadModel("Journee");
            $modEquipe = $this->loadModel('Equipe');
            $modChamp = $this->loadModel('Championnat');

            // Récupération des paramètres de la requête
            $idChampionnat = $_GET['idchampionnat'];
            $idJournee = $_GET['idjournee'];
            $nomPoule = isset($_GET['nompoule']) ? $_GET["nompoule"] : null;
            $equipes = [];

            $conditions = ['journee.idJournee' => $idJournee];

            if ($nomPoule) {
                $modRencontre->table .= " INNER JOIN poule ON poule.idChampionnat = championnat.idChampionnat";
                $conditions["nomPoule"] = $nomPoule;
            }

            $groupby = 'idEquipeA';
            $params = ['conditions' => $conditions, 'groupby' => $groupby];

            $rencontres = $modRencontre->find($params);
            $journee = $modJournee->find(["conditions" => ["idJournee" => $idJournee]])[0];

            foreach ($rencontres as $rencontre) {
                // Équipe A
                $conditions = ['equipe.idEquipe' => $rencontre->idEquipeA];
                $params = ['conditions' => $conditions];
                array_push($equipes, $modEquipe->find($params));
                // Équipe B
                $conditions = ['equipe.idEquipe' => $rencontre->idEquipeB];
                $params = ['conditions' => $conditions];
                array_push($equipes, $modEquipe->find($params));
            }

            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);

            $d['championnat'] = $modChamp->findFirst($params);
            $d['equipes'] = $equipes;
            $d['journee'] = $journee;
            $d['rencontre'] = $rencontres;

            $this->set($d);
        } else {
            $this->e404('Aucune rencontre trouvée. Nous nous execusons pour cet incident.');
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

    public function listePersonne() {
        $this->filterAndGetUser(2);

        $personneModele = $this->loadModel("Personne");

        $personnes = $personneModele->find([
            "orderby" => "personne.nom"
        ], "TAB");

        $this->set(["personnes" => $personnes]);

        $this->render("listePersonne");
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

                $arbitreModele->delete([
                    "conditions" => ["idArbitre" => $id]
                ]);
                $compteModele->delete([
                    "conditions" => ["idCompte" => $id]
                ]);

                $this->redirect("/admin/listeUtilisateur");
            }
        }
    }

    public function deletePersonne($id)
    {
        $c_user = $this->filterAndGetUser(2);

        $personneModele = $this->loadModel("Personne");
        $compteModele = $this->loadModel("Compte");

        $personne = $personneModele->find([
            "conditions" => ["idPersonne" => $id]
        ], "TAB");

        if (!$personne) {
            $this->e404("Cette personne n'existe pas.");
        } elseif ($personne[0]["idPersonne"] === $c_user["idCompte"]) {
            $this->e404("Vous ne pouvez pas vous supprimer vous-même.");
        }

        $personne = $personne[0];

        $this->set(["personne" => $personne]);

        if (isset($_POST["passwd"])) {
            $password = Security::hardEscape($_POST["passwd"]);

            $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

            if (!$validUser) {
                $this->set(["info" => "Mot de passe incorrect."]);
            } else {
                // Suppression de la personne

                $arbitreModele = $this->loadModel("Arbitre");

                $arbitreModele->delete([
                    "conditions" => ["idArbitre" => $id]
                ]);
                $compteModele->delete([
                    "conditions" => ["idCompte" => $id]
                ]);
                $personneModele->delete([
                    "conditions" => ["idPersonne" => $id]
                ]);

                $this->redirect("/admin/listePersonne");
            }
        }
    }

    public function formUtilisateur($id)
    {
        $c_user = $this->filterAndGetUser(1);

        $redirectURL = $c_user["typeCompte"] === "GÉRANT" ? "/admin/listeUtilisateur" : "/admin/listeChampionnat";

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
        $d["userId"] = $id;

        if ($newForm) {
            // Nouvel utilisateur
            $this->filterAndGetUser(2);

            if (isset($_POST["identifiant"], $_POST["password"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
                $password = Security::shorten($_POST["password"], 72);

                if (preg_match("/\W+/", $password))
                    $this->redirect($redirectURL);

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

                $this->redirect($redirectURL);
            }
        } else {
            // Mise à jour d'un utilisateur

            if (($c_user["idCompte"] !== $id) && ($c_user["typeCompte"] !== "GÉRANT")) {
                $this->filterAndGetUser(2);
            }

            if (isset($_POST["identifiant"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
                $password = (isset($_POST["password"]) && strlen($_POST["password"]) > 0) ? Security::shorten($_POST["password"], 72) : "";
                $hash = $password ? Security::hash($password) : "";
                $typeCompte = $_POST["typeCompte"];
                $idPersonne = $_POST["idPersonne"];

                $donneesCompte = [
                    "idCompte" => $idPersonne,
                    "identifiant" => $identifiant,
                    "typeCompte" => $typeCompte
                ];

                if ($password) {
                    if (preg_match("/\W+/", $password)) {
                        $this->redirect($redirectURL);
                    } else
                        $donneesCompte["password"] = $hash;
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

                if ($c_user["idCompte"] === $id) {
                    Session::set("identifiant", $identifiant);
                    if ($password) {
                        Session::set("hash", $hash);
                    }
                }

                $this->redirect($redirectURL);
            }

            $user = $compteModele->find([
                "conditions" => ["idCompte" => $id]
            ], "TAB");

            if (!$user)
                $this->e404("Cet utilisateur n'existe pas.");
            elseif (!$personnes)
                $this->e404("Il n'existe aucune personne dans la base de données.");

            $d["user"] = $user[0];
        }

        $this->set($d);

        $this->render("formUtilisateur");
    }

    public function formPersonne($id)
    {
        $this->filterAndGetUser(2);

        // Limites possible de l'âge
        $ageBounds = [15, 150];

        $redirectURL = "/admin/listePersonne";

        $personneModele = $this->loadModel("Personne");

        $newForm = !isset($id);

        $d["c_user"] = $newForm;
        $d["newForm"] = $newForm;
        $d["ageBounds"] = $ageBounds;

        $isAllSet = isset($_POST["nom"], $_POST["prenom"], $_POST["age"], $_POST["sexe"], $_POST["mail"], $_POST["adresse"]);


        if ($isAllSet) {

            $nom = Security::shorten(Security::hardEscape($_POST["nom"]), 64);
            $prenom = Security::shorten(Security::hardEscape($_POST["prenom"]), 64);
            $age = $_POST["age"];
            $sexe = $_POST["sexe"];
            $mail = filter_var(Security::shorten(Security::hardEscape($_POST["mail"]), 64), FILTER_VALIDATE_EMAIL);
            $adresse = Security::shorten(Security::hardEscape($_POST["adresse"]), 128);

            // L'adresse e-mail doit être valide.
            if (!$mail)
                $this->redirect($redirectURL);

            // L'âge doit être compris entre 15 et 150 (inclus).
            if (!Security::valueIsBetween($age, $ageBounds[0], $ageBounds[1]) || !is_numeric($age))
                $this->redirect($redirectURL);
        }

        if ($newForm) {
            // Nouvelle personne

            if ($isAllSet) {
                $personneModele->insert(
                    ["nom", "prenom", "age", "sexe", "mail", "adresse"],
                    [$nom, $prenom, $age, $sexe, $mail, $adresse]
                );

                $this->redirect($redirectURL);
            }
        } else {
            // Mise à jour d'une personne

            if ($isAllSet) {
                $personneModele->update([
                    "donnees" => [
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "age" => $age,
                        "sexe" => $sexe,
                        "mail" => $mail,
                        "adresse" => $adresse
                    ],
                    "conditions" => [
                        "idPersonne" => $id
                    ]
                ]);

                $this->redirect($redirectURL);
            }

            $personne = $personneModele->find([
                "conditions" => ["idPersonne" => $id]
            ], "TAB");

            if (!$personne)
                $this->e404("Cet utilisateur n'existe pas.");

            $d["personne"] = $personne[0];
        }

        $this->set($d);

        $this->render("formPersonne");
    }
}