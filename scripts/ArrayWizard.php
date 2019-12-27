<?php


class ArrayWizard
{
    public static function getFirstElementWhere($array, $key, $value) {
        foreach ($array as $item) {
            if ($item->$key === $value)
                return $item;
        }
        return null;
    }

    public static function arrayKeyFirst($array) {
        foreach ($array as $key => $value) {
            return $key;
        }
        return null;
    }
}