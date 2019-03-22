<?php

namespace Ls\Common\Helpers;


class JsonHelper
{

    public static function findInString($json)
    {
        $pattern = '/\{(?:[^{}]|(?R))*\}/x';
        preg_match_all($pattern, $json, $matches);
        return $matches;
    }

    public static function is(&$string)
    {
        $string = json_decode($string, true);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}