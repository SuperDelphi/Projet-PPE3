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

    function __destruct()
    {
        session_destroy();
    }
}
