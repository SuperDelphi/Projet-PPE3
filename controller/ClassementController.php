<?php

class ClassementController extends Controller
{

    private $modClassement = null;

    function liste()
    {
        $this->modClassement = $this->loadModel('Classement');
        $params = array();
        $projection = 'equipe.nomEquipe, equipe.scoreGlobal';
        $orderby = 'equipe.scoreGlobal DESC';
        $groupby = 'equipe.idEquipe';
        
        $params = array( 'projection' => $projection, 'orderby'=>$orderby, 'groupby'=>$groupby);
        $d['classement'] = $this->modClassement->find($params);
        //var_dump($d);
        if (empty($d['classement'])) {
            $this->e404('Page introuvable');
        }
        
        $this->set($d);
    }
    
    function tri() {
         
        
    
    }
    
}

