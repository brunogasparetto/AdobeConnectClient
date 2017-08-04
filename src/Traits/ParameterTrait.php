<?php

namespace AdobeConnectClient\Traits;

use AdobeConnectClient\Helpers\StringCaseTransform as SCT;
use AdobeConnectClient\Helpers\ValueTransform as VT;

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
            $values[SCT::toHyphen($prop)] = VT::toString($value);
        }
        return $values;
    }
}
