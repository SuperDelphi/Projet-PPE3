<?php

class DefautController extends Controller
{
    function index()
    {
        $url = "Location: http://" . SERVER . BASE_URL . "/championnat/liste";
        header($url);
    }

//Fonctions à replacer


//-- Fonction de récupération de l'adresse IP du visiteur
    function getIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        return $ip;
    }

    function currentIPStartsWith($ip)
    {
        // TODO À refaire
        $equals = false;
        while (!$equals) {
            list($w, $x, $y, $z) = explode('.', $ip);  // Exemple : 192.168.10.3 = w=192, x=168, y=10, z=3
            $iptronqSession = $w + "." + $x;

            if ($iptronqUser == $iptronqSession)
                echo("SUCCESSFUL");
            else
                echo("FAILED");

            $equals = TRUE;
        }

    }
}

?>