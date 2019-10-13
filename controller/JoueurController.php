<?php

class JoueurController extends Controller {

    private $modJoueur = null;
    
    function liste() {
        $this->modJoueur = $this->loadModel('Joueur');
        $d['joueurs'] = $this->modJoueur->find(array('conditions' => 1));
        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}