<?php

class JoueurController extends Controller {

    private $modJoueur = null;
    
    function liste() {
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, joueur.scoreGlobale';
        $orderby = 'joueur.scoreGlobale desc';
        $params = array('projection' => $projection, 'orderby' => $orderby);
        $d['joueurs'] = $this->modJoueur->find($params);
        //var_dump($d);
        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function detail($id) {
        $idJoueur = trim($id);
        $visible = 1;
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, personne.age, personne.mail, personne.adresse, joueur.licenceJoueur, joueur.scoreGlobal, equipe.nomEquipe';
        $conditions = array('idJoueur' => $idJoueur, 'visible' => $visible);
        $params = array('projection'=>$projection, 'conditions' => $conditions);
        $d['joueur'] = $this->modJoueur->findFirst($params);
        if (empty($d['joueur'])) {
            $this->e404('Informations inaccessibles');
        }
        //var_dump($d);
        $this->set($d);
    }
}