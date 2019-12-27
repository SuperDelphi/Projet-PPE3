<?php

class Security
{
    /**
     * @param string $string La chaîne de caractères à échapper.
     * @return string La chaîne de caractère passée en paramètre échappée.
     */
    static function hardEscape($string)
    {
        $string = addslashes($string);

        return $string;
    }

    /**
     * @param string $string La chaîne de caractères à raccourcir (si nécessaire).
     * @param int $length La longueur maximale que la chaîne de caractère peut avoir.
     * @param string $displayString La chaîne de caractères qui va informer de la troncation de la chaîne originale à l'affichage.
     * @return string La chaîne de caractère passée en paramètre (raccourcie par rapport à la longueur souhaitée
     * si celle-ci est plus élevée).
     */
    static function shorten($string, $length, $displayString="")
    {
        $originalLength = strlen($string);
        $string = substr($string, 0, $length);

        if (!$string) $string = "";
        if ($originalLength > $length AND $displayString !== "") $string .= $displayString;

        return $string;
    }

    /**
     * @param string $password La chaîne de caractères à hasher (algorithme BlowFish).
     * @return bool|string Le hash de la chaîne de caractères passée en paramètre.
     */
    static function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param int|float $value La valeur à tester.
     * @param int|float $min La valeur minimale.
     * @param int|float $max La valeur maximale.
     * @param bool $strict Si true, la comparaison sera stricte (false par défaut).
     * @return bool Si la valeur à tester est comprise (strictement ou non) entre les deux valeurs, true sera retourné,
     * sinon false.
     */
    static function valueIsBetween($value, $min, $max, $strict=false)
    {
        if ($strict)
            return $value > $min AND $value < $max;
        else
            return $value >= $min AND $value <= $max;
    }
}