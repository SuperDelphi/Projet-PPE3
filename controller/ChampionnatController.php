<?php 
class ChampionnatController extends Controller
{
    private $modChamp = null;

    function liste()
    {
        $this->modChamp = $this->loadModel("Championnat");
        $this->modPoule = $this->loadModel("Poule");

        $groupby = "championnat.idChampionnat";

        $d["championnats"] = $this->modChamp->find([
            "groupby" => $groupby,
            "orderby" => "idChampionnat"
        ]);

        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }

        $d["poules"] = $this->modPoule->find([
            "groupby" => "idChampionnat, nomPoule",
            "orderby" => "nomPoule"
        ]);

        $this->set($d);
        $this->render("liste");
    }
}
?>