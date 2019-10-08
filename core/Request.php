<?php

class Request {

    public $url; // URL appelée par le constructeur
    var $controller;
    var $action;
    var $params;

    function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
    }

}
