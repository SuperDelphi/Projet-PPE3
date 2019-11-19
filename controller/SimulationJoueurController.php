<?php


class SimulationJoueurController extends Controller
{
  
    function listeSimulation()
    {
        $this->render("listeSimulation");
    }

    function formSimulation()
    {
        if (isset($_POST["creerSimulation"])) {
            $simulationjoueurModele = $this->loadModel("SimulationJoueur");

            $nomJoueurA = $_POST["nomJoueurA"];
            $classementJoueurA = $_POST["ClassementJoueurA"];
            $nomJoueurB = $_POST["nomJoueurB"]; // TODO S'occuper de ça
            $classementJoueurB = $_POST["ClassementJoueurB"];
            $gagnant = $_POST["Gagnant"];
            
            $this->render("listeSimulation");
        }
    }

    
}

