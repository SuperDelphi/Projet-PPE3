<?php

class Security {
    static function hardEscape($string) {
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        $string = escapeshellcmd($string);
        $string = escapeshellarg($string);

        return $string;
    }
}