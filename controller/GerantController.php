<?php

class JoueurController extends Controller {

    private $modGerant = null;
    
    function liste() {
        $this->modGerant = $this->loadModel('Gerant');
        $d['gerants'] = $this->modGerant->find(array('conditions' => 1));
        if (empty($d['gerants'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}