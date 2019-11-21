<?php

class RencontreController extends Controller
{

    private $modRenc = null;

    function liste()
    {
        $idChampionnat = $_GET['idChampionnat'];
        $nomPoule = $_GET['nomPoule'];
        $j = array();
        $de = array();

        $modPoule = $this->loadModel('Poule');
        $conditions = array('idChampionnat' => $idChampionnat, 'nomPoule' => $nomPoule);
        $params = array('conditions' => $conditions);
        $equipesPoule = $modPoule->find($params);
        $d['equipesPoule'] = $equipesPoule;


        $this->modRenc = $this->loadModel('Rencontre');
        $conditions = array('championnat.idChampionnat' => $idChampionnat);
        $orderby = 'journee.numJournee';
        $params = array('conditions' => $conditions, 'orderby' => $orderby);
        $rencontres = $this->modRenc->find($params);

        //var_dump($rencontres);
        foreach ($rencontres as $rencontre) {
            $r = array();
            foreach ($equipesPoule as $equipePoule) {
                if ($rencontre->idEquipeA == $equipePoule->idEquipe) {
                    $de['rencontre'] = $rencontre;
                    array_push($r, $de);
                    //var_dump($r);
                }
            }
            if (!empty($r)){
                $r['idJournee'] = $rencontre->idJournee;
                $r['datePrev'] = $rencontre->date;
                array_push($j, $r);
                unset($r);
            }
        }
        $d['rencontres'] = $j;
        $d['nomPoule'] = $nomPoule;
        //var_dump($d);
        if (empty($d['rencontres'])) {
            $this->e404('Le calendrier du championnat sera prochainement publié');
        }

        $modChamp = $this->loadModel('Championnat');
        $conditions = array('championnat.idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $d['championnat'] = $modChamp->findFirst($params);

        $modEquipe = $this->loadModel('Equipe');
        $d['equipes'] = $modEquipe->find(array('conditions' => 1));
        
        $this->set($d);
    }

    function listeEquipePoule($id)
    {
        if (isset($id)) {
            $champPoule = explode("-", $id);
            $idChampionnat = trim($champPoule[0]);
            $nomPoule = trim($champPoule[1]);

            $modPoule = $this->loadModel('Poule');
            $projection = 'nomPoule';
            $conditions = array('idChampionnat' => $idChampionnat, 'nomPoule' => $nomPoule);
            $groupby = 'nomPoule';
            $params = array('projection' => $projection, 'conditions' => $conditions, 'groupby' => $groupby);
            $poule = $modPoule->find($params);
            $d['poule'] = $poule;

            if (empty($d['poule'])) {
                $this->e404('Poule introuvable');
            } else {
                $modEquipe = $this->loadModel('Equipe');
                $d['equipes'] = $modEquipe->find(array('conditions' => 1));
                $modEquipe->table .= "INNER JOIN poule ON poule.idEquipe = equipe.IdEquipe";
                $equipes = array();
                $equipesPoules = array();
                $conditions = array('nomPoule' => $poule[0]->nomPoule);
                $groupby = "equipe.idEquipe";
                $orderby = "equipe.scoreGlobal desc";
                $params = array('conditions' => $conditions, 'groupby' => $groupby, 'orderby' => $orderby);
                $equipes = $modEquipe->find($params);
            //var_dump($equipes);
                array_push($equipesPoules, $equipes);
                $d['equipesPoules'] = $equipesPoules;
            //var_dump($d);
                $modChamp = $this->loadModel('Championnat');
                $conditions = array('championnat.idChampionnat' => $idChampionnat);
                $params = array('conditions' => $conditions);
                $d['championnat'] = $modChamp->findFirst($params);
            }
            $this->set($d);
        } else {
            $this->e404('Poule introuvable');
        }
    }

    function detail($id)
    {
        $idRencontre = trim($id);
        $this->modRenc = $this->loadModel('Rencontre');
        $conditions = array('idRencontre' => $idRencontre);
        $params = array('conditions' => $conditions);
        $rencontre = $this->modRenc->find($params);
        $d['rencontre'] = $rencontre;

        $d['typeRencontre'] = array('A-X', 'B-Y', 'C-Z', 'B-X', 'A-Z', 'C-Y', 'B-Z', 'C-X', 'A-Y');

        $modEquipe = $this->loadModel('Equipe');
        $equipes = $modEquipe->find(array('conditions' => 1));
        $d['equipes'] = $equipes;

        $modPoule = $this->loadModel('Poule');
        $projection = 'nomPoule';
        $conditions = array('idChampionnat' => $rencontre[0]->idChampionnat, 'idEquipe' => $equipes[0]->idEquipe);
        $groupby = 'nomPoule';
        $params = array('projection' => $projection, 'conditions' => $conditions, 'groupby' => $groupby);
        $d['poules'] = $modPoule->find($params);

        $modJoueur = $this->loadModel('Joueur');
        $d['joueurs'] = $modJoueur->find(array('conditions' => 1));

        $modDivision = $this->loadModel('Division');
        $d['divisions'] = $modDivision->find(array('conditions' => 1));

        $modDetailMatch = $this->loadModel('DetailMatch');
        $conditions = array('idRencontre' => $idRencontre);
        $params = array('conditions' => $conditions);
        $d['matchs'] = $modDetailMatch->find($params);

        if (empty($d['matchs'])) {
            $this->e404('Les résultats de la rencontre seront prochainement publiés.');
        }

        $this->set($d);
    }
}
?>