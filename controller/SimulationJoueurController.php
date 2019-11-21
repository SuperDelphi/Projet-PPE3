<?php

class SimulationJoueurController extends Controller {

    function listeSimulation() {
        $this->render("listeSimulation");
    }

    function formSimulation() {
        if (isset($_POST["creerSimulation"])) {
            $simulationjoueurModele = $this->loadModel("SimulationJoueur");
            //récupération des variables du formulaire avec la méthode post
            $nomJoueurA = $_POST["nomJoueurA"];
            $classementJoueurA = $_POST["ClassementJoueurA"];
            $nomJoueurB = $_POST["nomJoueurB"];
            $classementJoueurB = $_POST["ClassementJoueurB"];
            $gagnant = $_POST["Gagnant"];
            $perdant = "";
            $Perf1 = 20;
            $Perf2 = 30;
            $bool = null;

            //Fonction qui détermine le gagnant.
            if ($gagnant == 'JoueurB') {
                $bool = true;
                $gagnant = $classementJoueurB;
                $perdant = $classementJoueurA;
            } else {
                $bool = false;
                $gagnant = $classementJoueurA;
                $perdant = $classementJoueurB;
            }

            //Calcul du classement

            if ($classementJoueurA >= $classementJoueurB) {
                $diff = $classementJoueurA - $classementJoueurB;
            } else {
                $diff = $classementJoueurB - $classementJoueurA;
            }

            if ($diff < 0) {
                $gagnant = 0;
                $perdant = 0;
            } elseif ($diff >= 0 && $diff <= 49) {
                $gagnant = 5;
                $perdant = 5;
            } elseif ($diff >= 50 && $diff <= 99) {
                $gagnant = 15;
                $perdant = 10;
            } elseif ($diff >= 100 && $diff <= 149) {
                $gagnant = 25;
                $perdant = 20;
            } elseif ($diff >= 150 && $diff <= 199) {
                $gagnant = 40 + $Perf1;
                $perdant = 35;
            } elseif ($diff >= 200) {
                $gagnant = 50 + $Perf2;
                $perdant = 45;
            }

            //Ré-attribue les points en fonction de si A ou B est gagnant
            if ($bool) {
                $classementJoueurB += $gagnant;
                $classementJoueurA -= $perdant;
                if ($classementJoueurA < 500) {
                    $classementJoueurA = 500; //On ne descend pas en dessous de 500
                } elseif ($classementJoueurA < 500) {
                    $classementJoueurB = 500; //On ne descend pas en dessous de 500
                }
            } else {
                $classementJoueurA += $gagnant;
                $classementJoueurB -= $perdant;
                if ($classementJoueurA < 500) {
                    $classementJoueurA = 500; //On ne descend pas en dessous de 500
                } elseif ($classementJoueurB < 500) {
                    $classementJoueurB = 500; //On ne descend pas en dessous de 500
                }
            }



            //On créer un tableau dans lequel on stock les variables que l'on veut afficher

            $d = array();
            $d['nomJoueurA'] = $nomJoueurA;
            $d['nomJoueurB'] = $nomJoueurB;
            $d['classementJoueurA'] = $classementJoueurA;
            $d['classementJoueurB'] = $classementJoueurB;
            $d['gagnant'] = $gagnant;
            //On affecte ces variables au tableau
            $this->set($d);
            //On renvoi les données à la VUE 
            $this->render("listeSimulation");
        }
    }

}
