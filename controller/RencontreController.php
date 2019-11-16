<?php

class RencontreController extends Controller
{

    private $modRenc = null;

    function liste($id)
    {
        $idChampionnat = trim($id);

        $modPoule = $this->loadModel('Poule');
        $projection = 'nomPoule';
        $conditions = array('idChampionnat' => $idChampionnat);
        $groupby = 'nomPoule';
        $params = array('projection' => $projection, 'conditions' => $conditions, 'groupby' => $groupby);
        $poules = $modPoule->find($params);

        $nbrjournee = 0;
        $j = array();
        $d = array();

        $d['poules'] = $poules;

        $this->modRenc = $this->loadModel('Rencontre');
        $this->modRenc->table = $this->modRenc->table . "INNER JOIN poule ON poule.idChampionnat = championnat.idChampionnat";
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
            $r['rencontre'] = $this->modRenc->find($params);
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

        $modEquipe = $this->loadModel('Equipe');
        $d['equipes'] = $modEquipe->find(array('conditions' => 1));
        //var_dump($d);
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
        $d['rencontre'] = $this->modRenc->find($params);

        $modJoueur = $this->loadModel('Joueur');
        $d['joueurs'] = $modJoueur->find(array('conditions' => 1));

        $modEquipe = $this->loadModel('Equipe');
        $d['equipes'] = $modEquipe->find(array('conditions' => 1));

        $modDivision = $this->loadModel('Division');
        $d['divisions'] = $modDivision->find(array('conditions' => 1));

        $modDetailMatch = $this->loadModel('DetailMatch');
        $conditions = array('idRencontre' => $idRencontre);
        $params = array('conditions' => $conditions);
        $d['matchs'] = $modDetailMatch->find($params);

        if (empty($d['matchs'])) {
            $this->e404('Les résultats de la rencontre seront prochainement publiés.');
        }
        //var_dump($d);
        $this->set($d);
    }
}
?>