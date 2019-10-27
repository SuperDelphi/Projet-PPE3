<?php

class Session
{
    static function set($k, $v)
    {
        $k = "'$k'";
        $_SESSION[$k] = $v;
    }

    static function get($k)
    {
        $k = "'$k'";
        if (isset($_SESSION[$k])) {
            return $_SESSION[$k];
        } else {
            return null;
        }
    }

    public static function destruct()
    {
        session_destroy();
    }

    public static function login($user, $hash, $accountType)
    {
        $ip = "";

        // Récupère l'IP du client
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        // On détermine le format de l'adresse IP (IPv4/v6)
        if (count(explode(":", $ip)) > 1)
            $delimiter = ":";
        else
            $delimiter = ".";

        $ip = explode($delimiter, $ip);

        $ippref = $ip[0] . $delimiter . $ip[1];

        $_SESSION["identifiant"] = $user;
        $_SESSION["hash"] = $hash;
        $_SESSION["type"] = $accountType;
        $_SESSION["ippref"] = $ippref;
    }
}
