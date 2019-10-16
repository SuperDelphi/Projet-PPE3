<?php

class DefautController extends Controller
{
    function index()
    {
        $url = "Location: http://" . SERVER . BASE_URL . "/joueur/liste";
        header($url);
    }
}

?>