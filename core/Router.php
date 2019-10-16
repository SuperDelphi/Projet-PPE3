<?php

/**
 * Permet de parser une URL.
 */
class Router
{

    static function parse($request)
    {
        // Modification de l'url en cas de "//"
        if (strpos($request->url, '//') !== false) {
            $request->url = strtr($request->url, ['//' => '/']);
            header('Status: 301 Moved Permanently', false, 301);
            header('Location: ' . $request->url);
        }

        $request->url = trim($request->url, '/');

        $params = explode('/', $request->url);

        // Compte le nombre de paramètres pour les URL de sous-dossiers

        $taille = count($params);

        // URL du style : /controller/action/param

        if ($taille >= 2) {
            if ($params[0] === trim(BASE_URL, '/')) {
                // URL du style : /XXXXX/controller/action/param
                if (isset($params[1])) {
                    $controller = $params[1];
                } else {
                    return null;
                }

                if (isset($params[2])) {
                    $action = $params[2];
                } else {
                    return null;
                }

                if (isset($params[3])) {
                    $param = $params[3];
                } else {
                    $param = null;
                }
            } else {
                // URL du style : /controller/action/param
                if (isset($params[0])) {
                    $controller = $params[0];
                }

                if (isset($params[1])) {
                    $action = $params[1];
                } else {
                    return null;
                }

                if (isset($params[2])) {
                    $param = $params[2];
                } else {
                    $param = null;
                }
            }
        } else {
            // Action par défaut
            $controller = 'defaut';
        }

        $request->controller = $controller;
        $request->action = isset($action) ? $action : 'index';
        $request->params = $param;

        return true;
    }

}
