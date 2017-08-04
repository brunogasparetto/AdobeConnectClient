<?php

namespace AdobeConnectClient\Helpers;

use DateTimeInterface;
use DateTime;
use DateTimeImmutable;
use AdobeConnectClient\Helpers\BooleanTransform as BT;

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
            return BT::toString($value);
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
}
