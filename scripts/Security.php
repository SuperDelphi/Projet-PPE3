<?php

class Security {
    static function hardEscape($string) {
        $string = addslashes($string);
        // TODO Ajouter éventuellement d'autres fonctions d'échappement

        return $string;
    }

    static function shorten($string, $length) {
        $string = substr($string, 0, $length);

        return $string;
    }
}