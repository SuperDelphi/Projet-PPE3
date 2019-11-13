<?php

class Parser
{
    static function getEnumValuesFromRaw($raw)
    {
        $raw = substr($raw, 5, -1);
        $raw = explode(",", $raw);
        for ($i = 0;$i < count($raw);$i++) {
            $raw[$i] = substr($raw[$i], 1, -1);
        }

        return $raw;
    }
}