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

//put your code here

    /**
     *
     * permet de charger un model
     */
    function loadModel($name)
    {
        $file = ROOT . DS . 'model' . DS . $name . '.php';
        require_once($file);
        //if (!isset($this->name)) {
        $this->name = new $name();
        //}
        return $this->name;
    }

    /**
     *
     * permet de gerer les erreurs e404
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
     * redirection vers une autre page
     *
     */
    function redirect($page)
    {
        $url = 'Location: http://' . SERVER . BASE_URL . $page;
        header("$url");
    }

}
