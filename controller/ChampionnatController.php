<?php 
class ChampionnatController extends Controller {
    private $modChamp = null;

    function liste() {
        $this->modChamp = $this->loadModel('Championnat');
        $d['championnat'] = $this->modChamp->find(array('conditions' => 1));
        if (empty($d['championnat'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}
?>