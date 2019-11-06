<?php

class RencontreController extends Controller {

private $modRenc = null;

function liste() {
    $this->modRenc = $this->loadModel('Rencontre');
    $d['rencontres'] = $this->modRenc->find(array('conditions' => 1));
    if (empty($d['rencontres'])) {
        $this->e404('Page introuvable');
    }
    $this->set($d);
}
}
?>