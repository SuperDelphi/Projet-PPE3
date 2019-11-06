<?php 
class ChampionnatController extends Controller {
    private $modChamp = null;

    function liste() {
        $this->modChamp = $this->loadModel('Championnat');
        $d['championnats'] = $this->modChamp->find(array('conditions' => 1));
        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}
?>