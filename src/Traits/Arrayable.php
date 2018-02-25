<?php

namespace AdobeConnectClient\Traits;

use AdobeConnectClient\Helpers\StringCaseTransform as SCT;
use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * Override the methods to turn into a valid ArrayableInterface
 */
trait Arrayable
{
    /**
     * Retrieves all not null attributes in an associative array
     *
     * The keys in hash style: Ex: is-member
     * The values as string
     *
     * @return string[]
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
