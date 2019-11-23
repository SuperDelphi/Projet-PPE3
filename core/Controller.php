<?php

class Controller
{

    public $request;
    public $layout = 'default';
    public $name;
    private $vars = array();
    private $rendered = false;

    function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Charge un modèle
     */
    function loadModel($name)
    {
        $file = ROOT . DS . 'model' . DS . $name . '.php';
        require_once($file);

        if (!isset($this->name)) {
            $this->name = new $name();
            return $this->name;
        } else {
            return new $name();
        }
    }

    function call($action, $params) {
        $this->runRoutine($action, $params);
        call_user_func(array($this, $action), $params);
    }

    /**
     * Gère les erreurs 404
     */
    function e404($message)
    {
        $this->set('message', $message);
        $this->render('/errors/404');

        die();
    }

    function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
        $this->vars['role'] = SESSION::get('role');
    }

    function render($view)
    {
        if ($this->rendered) {
            return false;
        }
        $this->rendered = true;
        extract($this->vars);
        if (strpos($view, '/') === 0) {
            $fview = ROOT . DS . 'view' . $view . '.php';
        } else {
            $fview = ROOT . DS . 'view' . DS . $this->request->controller . DS . $view . '.php';
        }

        ob_start();
        require($fview);
        $content_for_layout = ob_get_clean();
        require ROOT . DS . 'view' . DS . 'layout' . DS . $this->layout . '.php';
    }

    /**
     * Redirection vers une autre page
     */
    function redirect($page)
    {
        $url = 'Location: http://' . SERVER . BASE_URL . $page;
        header("$url");
    }

    function runRoutine($action, $params) {
        // Instructions à exécuter à chaque appel du contrôleur
    }

}
