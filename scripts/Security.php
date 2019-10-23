<?php

class Security {
    static function hardEscape($string) {
        $string = addslashes($string);
        // TODO Ajouter éventuellement d'autres fonctions d'échappement

        return $string;
    }
}