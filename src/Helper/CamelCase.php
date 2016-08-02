<?php

namespace Bruno\AdobeConnectClient\Helper;

/**
 * Converts string into Camel Case and vice-versa.
 */
abstract class CamelCase
{
    /**
     * Converts the Camel Case to Hyphen
     * @param string $term
     * @return string
     */
    public static function toHyphen($term)
    {
        return self::camelCaseTransform($term, '-');
    }

    /**
     * Converts the Camel Case to Dash
     * @param string $term
     * @return string
     */
    public static function toDash($term)
    {
        return self::camelCaseTransform($term, '_');
    }

    /**
     * Converts the Camel Case to Space
     * @param string $term
     * @return string
     */
    public static function toSpace($term)
    {
        return self::camelCaseTransform($term, ' ');
    }

    /**
     * Converts any string to Camel Case
     * @param string $term
     * @return string
     */
    public static function toCamelCase($term)
    {
        return preg_replace_callback(
            '/[\s_-](\w)/',
            function ($matches) {return mb_strtoupper($matches[1]);},
            $term
        );
    }
    
    /**
     * Converts the Camel Case to a string replace with the letter
     * @param string $term The string to convert
     * @param string $letter The letter to replace with
     * @return string
     */
    protected static function camelCaseTransform($term, $letter)
    {
        return mb_strtolower(preg_replace('/([A-Z])/', $letter . '$1', $term));
    }
}
