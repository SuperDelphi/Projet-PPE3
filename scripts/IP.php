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

    public static function isIPv6Format($ip)
    {
        return count(explode(":", $ip)) > 1;
    }

    public static function startsWithPrefix($ip, $prefix)
    {
        return $prefix === substr($ip, 0, strlen($prefix));
    }
}