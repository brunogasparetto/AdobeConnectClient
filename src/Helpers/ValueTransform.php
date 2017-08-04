<?php

namespace AdobeConnectClient\Helpers;

use DateTimeInterface;
use DateTime;
use DateTimeImmutable;

/**
 * Converts the value into a type.
 */
abstract class ValueTransform
{
    /**
     * Converts arbitrary value into string
     *
     * @param mixed $value
     * @return string
     */
    public static function toString($value)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format(DateTime::W3C);
        }
    }

    /**
     * Converts arbitrary value into DateTimeImmutable
     *
     * @param mixed $value
     * @return DateTimeImmutable
     */
    public static function toDateTimeImmutable($value)
    {
        if ($value instanceof DateTimeImmutable) {
            return $value;
        }

        if ($value instanceof DateTime) {
            return DateTimeImmutable::createFromMutable($value);
        }

        return new DateTimeImmutable((string) $value);
    }

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
}
