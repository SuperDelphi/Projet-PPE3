<?php

class Dispatcher
{

    var $request;

    function __construct()
    {
        $this->request = new Request();

        // Extraction du nom du contrôleur. L'action et les paramètres de l'url sont stockés dans "request".
        Router::parse($this->request);

        // Instanciation du bon contrôleur
        $controller = $this->loadController();

        /*
         * Vérifie la correspondance de l'action de l'URL avec
         * le nom d'une des méthodes du contrôleur que l'on vient d'instancier.
         */
        if (!in_array($this->request->action, get_class_methods($controller))) {
            $this->error('Fonctionnalité non implémentée : ' . $this->request->action);
        }

        /*
         * Cette fonction permet d'appeler la méthode d'un objet en lui donnant:
         * le nom de l'objet, le nom de la méthode et la liste des paramètres.
         */
        $controller->call($this->request->action, $this->request->params);

        /*
         * Appelle et remplit la bonne vue.
         */
        $controller->render($this->request->action);
    }

    /*
     * Grâce au nom du contrôleur (stocké dans "request"), on fabrique le nom de la classe contrôleur à instancier :
     * le nom du contrôleur est issu de l'url (1 lettre en majuscule) + la chaîne 'Controller'.
     */
    function loadController()
    {

        $name = ucfirst($this->request->controller) . 'Controller';
        $file = ROOT . DS . 'controller' . DS . $name . '.php';
        require $file;
        return new $name($this->request);
    }

    function error($message)
    {
        $controller = new Controller($this->request);
        $controller->e404($message);
    }

}