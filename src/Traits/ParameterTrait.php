<?php

namespace AdobeConnectClient\Traits;

use DateTime;
use AdobeConnectClient\Helpers\BooleanTransform as BT;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;

/**
 * Override the methods to turn into a valid ParameterInterface
 */
trait ParameterTrait
{
    /**
     * Retrieves all not null attributes as an associative array
     *
     * @return array An associative array
     */
    public function toArray()
    {
        $values = [];

        foreach ($this as $prop => $value) {
            if (!isset($value)) {
                continue;
            }
            if (is_bool($value)) {
                $value = BT::toString($value);
            } elseif ($value instanceof DateTime) {
                $value = $value->format(DateTime::W3C);
            }
            $values[SCT::toHyphen($prop)] = $value;
        }
        return $values;
    }
}
