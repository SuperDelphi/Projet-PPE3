<?php


class AdminController extends Controller
{
    function listeChampionnat()
    {
        $this->render("listeChampionnat");
    }

    function formChampionnat()
    {
        $divisionModele = $this->loadModel("division");
        $d["divisions"] = $divisionModele->find();
        $this->set($d);
        $this->render("formChampionnat");
    }
}