<?php

class RencontreController extends Controller {

    private $modRenc = null;

    function liste($id) {
        $idChampionnat = trim($id);
        $this->modRenc = $this->loadModel('Rencontre');
        $modJournee = $this->loadModel('Journee');
        $conditions = array('idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $journees = $modJournee->find($params);
        $nbrjournee = 0;
        $j = array();
        $d = array();
        foreach ($journees as $journee){
            $conditions = array('journee.idJournee' => $journee->idJournee, 'championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $r['dateprev'] = $journee->datePrev;
            $r['rencontre'] = $this->modRenc->find($params);
            array_push($j, $r);
            $nbrjournee++;

        }
        $d['journee'] = $j;
        $d['nbrjournee'] = $nbrjournee;
        if (empty($d['journee'])) {
            $this->e404('Page introuvable');
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
}
?>