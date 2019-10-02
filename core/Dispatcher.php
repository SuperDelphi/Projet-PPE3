<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dispatcher
 *
 * @author travail
 */
class Dispatcher {

    //put your code here
    var $request;

    function __construct() {

        $this->request = new Request();
        //extraire le nom du contrôleur, l'action et les paramètres de l'url stockée dans request et les stocker toujours dans request
        Router::parse($this->request);
        //instancier le contrôleur qui va bien
        $controller = $this->loadController();
        /*
         * On vérifie que l'action de l'URL correspond à une méthode du contrôleur que
         * l'on vient d'instancier
         */
        if (!in_array($this->request->action, get_class_methods($controller))) {
            $this->error('Fonctionnalité non implémentée : ' . $this->request->action);
        }
        /*
         * Cette fonction permet d'appeler la méthode d'un objet en lui donnant:
         * le nom de l'objet, le nom de la méthode, la liste des paramètres
         */
        call_user_func(array($controller, $this->request->action), $this->request->params);
        /*
         * Cette méthode remplit et appelle la vue qui va bien
         */
        $controller->render($this->request->action);
    }

    /*
     * Grâce au nom du contrôleur (stocké dans request), on fabrique le nom de la classe contrôleur à instancier:
     * nom du contrôleur issu de l'url (1 lettre en majuscule)+ chaîne 'controller'.
     */

    function loadController() {

        $name = ucfirst($this->request->controller) . 'Controller';
        $file = ROOT . DS . 'controller' . DS . $name . '.php';
        require $file;
        return new $name($this->request);
    }

    function error($message) {

        $controller = new Controller($this->request);
        $controller->e404($message);
    }

}
