<?php

class ClassementController extends Controller
{

    private $modClassement = null;

    function liste()
    {
        $this->modClassement = $this->loadModel('Classement');
        $d['classement'] = $this->modClassement->find(array('conditions' => 1));
        if (empty($d['classement'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
    
    function tri() {
        
    }
    
}

