<?php

class ArbitreController extends Controller
{

    private $modArbitre = null;

    function liste()
    {
        $this->modArbitre = $this->loadModel('Arbitre');
        $d['arbitres'] = $this->modArbitre->find(array('conditions' => 1));
        if (empty($d['arbitres'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}
