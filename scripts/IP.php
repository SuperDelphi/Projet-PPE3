<?php


class IP
{
    public static function getUserIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        return $ip;
    }

    public static function checkTruncation($ip, $truncation)
    {
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