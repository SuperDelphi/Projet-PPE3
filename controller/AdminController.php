<?php


class AdminController extends Controller
{
    function listeChampionnat()
    {
        $this->render("listeChampionnat");
    }

    function formChampionnat()
    {
        $division = $this->loadModel()
        $this->render("formChampionnat");
    }
}