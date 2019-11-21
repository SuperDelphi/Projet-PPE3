<?php

class EquipeController extends Controller {

     private $modEquipe = null;

    function listeEquipe() {
        $this->modEquipe = $this->loadModel('Equipe');
        $groupby = "equipe.idEquipe";
        $params = array();
        $params = array('groupby' => $groupby);
        $d['equipes'] = $this->modEquipe->find($params);
        if (empty($d['equipes'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("listeEquipe");
    }

    function formEquipe() {
        $this->redirectNonLogged();
        if (isset($_POST["creerEquipe"])) {
            $equipeModele = $this->loadModel("Equipe");
            $nomEquipe = $_POST["nomEquipe"];
            $idClub = $_POST["idClub"];
            $idDivision = $_POST["idDivision"];

            $equipeModele->insertAI(
                    ["nomEquipe", "idClub", "idDivision"], [$nomEquipe, $idClub, $idDivision]
            );
            $this->redirect("/admin/listeEquipe");
        } else {
            $clubModele = $this->loadModel("Club");
            $divisionModele = $this->loadModel("Division");
            
            $d["clubs"] = $clubModele->find();
            $d["divisions"] = $divisionModele->find();
            
            

            $this->set($d);
            $this->render("formEquipe");
        }
}
}
?>