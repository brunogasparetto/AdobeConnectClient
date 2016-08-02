<?php

namespace Bruno\AdobeConnectClient\Helper;

/**
 * Converts Boolean values to string and vice-versa.
 */
abstract class BooleanStr
{
    /**
     * Converts a string to boolean
     *
     * @param string $str
     * @return boolean
     */
    public static function toBoolean($str)
    {
        $str = mb_strtolower($str);

        if ($str === 'false' or $str === 'off') {
            return false;
        } elseif ($str === 'true' or $str === 'on') {
            return true;
        } else {
            return boolval($str);
        }
    }

    /**
     * Converts a boolean to string
     * 
     * @param boolean $bool
     * @return string
     */
    public static function toString($bool)
    {
        return boolval($bool) ? 'true' : 'false';
    }
}
