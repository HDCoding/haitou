<?php

namespace App\Torrent;

class Encoder
{
    /**
     * @return string
     */
    public function __toString()
    {
        return self::encode($this);
    }

    /**
     * @param $mixed
     * @return string
     */
    public static function encode($mixed)
    {
        switch (gettype($mixed)) {
            case 'integer':
            case 'double':
                return self::encodeInteger(round($mixed));
                break;
            case 'object':
                $mixed = get_object_vars($mixed); // no break
            case 'array':
                return self::encodeArray($mixed);
                break;
            default:
                return self::encodeString($mixed);
                break;
        }
    }

    /**
     * @param $string
     * @return string
     */
    private static function encodeString($string)
    {
        return strlen($string) . ':' . $string;
    }

    /**
     * @param $integer
     * @return string
     */
    private static function encodeInteger($integer)
    {
        return 'i' . $integer . 'e';
    }

    /**
     * @param $array
     * @return string
     */
    private static function encodeArray($array)
    {
        if (self::isList($array)) {
            // We build a List
            ksort($array, SORT_NUMERIC);
            $return = 'l';
            foreach ($array as $value) {
                $return .= self::encode($value);
            }
        } else {
            // We build a Dictionary
            ksort($array, SORT_STRING);
            $return = 'd';
            foreach ($array as $key => $value) {
                $return .= self::encode(strval($key)) . self::encode($value);
            }
        }
        return $return . 'e';
    }

    /**
     * @param $array
     * @return bool
     */
    protected static function isList($array)
    {
        // Check for strings in the keys
        foreach (array_keys($array) as $key) {
            if (!is_int($key)) {
                return false;
            }
        }
        return true;
    }
}