<?php

class DefaultController extends Controller
{
    function index()
    {
        $url = "Location: http://" . SERVER . BASE_URL . "/";
        header($url);
    }
}

?>