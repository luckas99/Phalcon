<?php

namespace Ls\Common\Helpers;

class ArrayHelper
{
    public static function findItem($array, $columnName, $columnValue)
    {
        $columnItems = array_map(function ($o) use ($columnName) {
            return $o[$columnName];
        }, $array);

        $columnIndex = array_search($columnValue, array_column($columnItems, $columnName), false);
        if ($columnIndex > -1) {
            return $array[$columnIndex];
        } else {
            return null;
        }
    }

    public static function map(array $array, $function)
    {
        if (!is_callable($function)) {
            return [];
        }

        return array_map($function, $array);
    }

    public static function sortItems(array $array, $columnName, $sortOrder = SORT_ASC)
    {
        if (!isset($array) || empty($array))
            return $array;

        foreach ($array as $key => $row) {
            $volume[$key] = $row[$columnName];
        }
        $dataSorted = $array;
        array_multisort($volume, $sortOrder, $dataSorted);

        return $dataSorted;
    }

    public static function addAfterColumn(array &$array, $column, $name, $appendValue)
    {
        $countPosition = 1;
        foreach ($array as $columnName => $value) {
            if ($columnName === $column)
                break;
            $countPosition++;
        }

        $totalOfArray = count($array);
        if ($totalOfArray === $countPosition) {
            $array[$name] = $appendValue;
            return;
        }

        // Separating blocks
        $firstBlock = array_slice($array, 0, $countPosition, true);
        $secondBlock = array_slice($array, $countPosition, ($totalOfArray - $countPosition), true);

        // Preparing middle block
        $appendArray = [];
        $appendArray[$name] = $appendValue;

        // Recreating new array
        $array = [];
        $array = array_merge($firstBlock, $appendArray, $secondBlock);
    }

    public static function explode($delimiter, $string, $limit = null)
    {
        $explode = (!empty($limit)) ?
            explode($delimiter, trim($string), $limit) :
            explode($delimiter, trim($string));

        return self::map($explode, function ($word) {
            return trim($word);
        });
    }

    public static function stringImplodes(array $array, $common = ', ', $last = ' e ')
    {
        self::trim($array);

        if (count($array) === 2) return implode($last, $array);

        if (count($array) > 2) {
            $lastText = $array[count($array) - 1];
            unset($array[count($array) - 1]);

            $string = implode($common, $array);
            return implode($last, [$string, $lastText]);
        }

        return (isset($array[0])) ? $array[0] : '';
    }

    public static function trim(array &$array)
    {
        if (!isset($array) || empty($array)) return;
        foreach ($array as $row => $value) {
            if (gettype($value) === 'array') self::trim($array[$row]);
            if (gettype($value) === 'object') self::trimObject($array[$row]);
            else $array[$row] = trim($value);
        }
    }

    public static function trimObject(&$object)
    {
        if (!isset($object) || empty($object)) return;
        foreach ($object as $row => $value) {
            if (gettype($value) === 'array') self::trim($object->$row);
            if (gettype($value) === 'object') self::trimObject($object->$row);
            else $object->$row = trim($value);
        }
    }

    public static function cleanNulls(array &$array, $array_values = false)
    {
        if (!isset($array) || empty($array)) return;
        foreach ($array as $row => $value) {
            if (gettype($value) === 'array') self::cleanNulls($array[$row]);
            else if (empty($value)) unset($array[$row]);
        }

        if ($array_values) $array = array_values($array);
    }

    public static function isNumericIndexes(array $array)
    {
        $i = 0;
        foreach ($array as $a => $b) if (is_int($a)) ++$i;
        if (count($array) === $i) return true;
        else return false;

    }
}
