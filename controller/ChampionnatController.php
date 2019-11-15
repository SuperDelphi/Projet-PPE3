<?php 
class ChampionnatController extends Controller {
    private $modChamp = null;

    function liste() {
        $this->modChamp = $this->loadModel('Championnat');
        $groupby = "championnat.idChampionnat";
        $params = array();
        $params = array('groupby' => $groupby);
        $d['championnats'] = $this->modChamp->find($params);
        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("liste");
    }
}
?>