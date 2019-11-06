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
        asort($d['classement']);
        $this->set($d);
    }
    
    function tri() {
         
        $this->modClassement = $this->loadModel('Classement');
        $projection = 'equipe.nomEquipe, equipe.scoreGlobal';
        $d['classement'] = $this->modClassement->find(array($projection=>'projection'));
        arsort($d['classement']);
        $tableauTri = array();
        
        foreach ($classement as $d) {
             
        }
        
        
        
        if (empty($d['classement'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    
    }
    
}

