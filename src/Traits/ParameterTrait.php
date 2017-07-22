<?php

namespace AdobeConnectClient\Traits;

use \AdobeConnectClient\Helper\BooleanTransform as BT;
use \AdobeConnectClient\Helper\StringCaseTransform as SCT;

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
            if (\is_bool($value)) {
                $value = BT::toString($value);
            } elseif ($value instanceof \DateTime) {
                $value = $value->format(\DateTime::W3C);
            }
            $values[SCT::toHyphen($prop)] = $value;
        }
        return $values;
    }
}
