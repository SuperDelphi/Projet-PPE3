<?php

class JoueurController extends Controller {

    private $modJoueur = null;
    
    function liste() {
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, joueur.scoreGlobal';
        $orderby = 'joueur.scoreGlobal desc';
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
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, personne.age, personne.mail, personne.adresse, joueur.licenceJoueur, joueur.scoreGlobal, equipe.nomEquipe';
        $conditions = array('idJoueur' => $idJoueur);
        $params = array('projection'=>$projection, 'conditions' => $conditions);
        $d['joueur'] = $this->modJoueur->findFirst($params);
        if (empty($d['joueur'])) {
            $this->e404('Clé invalide');
        }
        //var_dump($d);
        $this->set($d);
    }
}